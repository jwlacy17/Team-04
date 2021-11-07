
const SomeApp = {
    data() {
      return {
        students: [],
        selectedStudent: null,
        offers: [],
        refs: [],
        games: [],
        assignments: [],
        offerForm: {},
        selectedOffer: null,
        selectedOffer: null
      }
    },
    computed: {},
    methods: {
        prettyData(d) {
            return dayjs(d)
            .format('D MMM YYYY')
        },
        prettyDollar(n) {
            const d = new Intl.NumberFormat("en-US").format(n);
            return "$ " + d;
        },
        selectStudent(s) {
            if (s == this.selectedStudent) {
                return;
            }
            this.selectedStudent = s;
            this.offers = [];
            this.fetchOfferData(this.selectedStudent);
        },
        fetchStudentData() {
            fetch('/api/student/')
            .then( response => response.json() )
            .then( (responseJson) => {
                console.log(responseJson);
                this.students = responseJson;
            })
            .catch( (err) => {
                console.error(err);
            })
        },
        fetchOfferData(s) {
            console.log("Fetching offer data for ", s);
            fetch('/api/offer/?student=' + s.id)
            .then( response => response.json() )
            .then( (responseJson) => {
                console.log(responseJson);
                this.offers = responseJson;
            })
            .catch( (err) => {
                console.error(err);
            })
            .catch( (error) => {
                console.error(error);
            });
        },
        fetchRefData() {
            fetch('/api/ref/')
            .then( response => response.json() )
            .then( (responseJson) => {
                console.log(responseJson);
                this.refs = responseJson;
            })
            .catch( (err) => {
                console.error(err);
            })
        }, 
        fetchGameData() {
            fetch('/api/game/')
            .then( response => response.json() )
            .then( (responseJson) => {
                console.log(responseJson);
                this.games = responseJson;
            })
            .catch( (err) => {
                console.error(err);
            })
        },
        fetchAssignmentData() {
            fetch('/api/assignment/')
            .then( response => response.json() )
            .then( (responseJson) => {
                console.log(responseJson);
                this.assignments = responseJson;
            })
            .catch( (err) => {
                console.error(err);
            })
        },
        postOffer(evt) {
            console.log ("Test:", this.selectedOffer);
          if (this.selectedOffer) {
              this.postEditOffer(evt);
          } else {
              this.postNewOffer(evt);
          }
        },
        postNewOffer(evt) {
            // this will post new book
             // this.offerForm.studentId = this.selectedStudent.id;        
              console.log("Posting:", this.offerForm);
  
              fetch('api/ref/create.php', {
                  method:'POST',
                  body: JSON.stringify(this.offerForm),
                  headers: {
                    "Content-Type": "application/json; charset=utf-8"
                  }
                })
                .then( response => response.json() )
                .then( json => {
                  console.log("Returned from post:", json);
                  // TODO: test a result was returned!
                  this.refs = json;
                  
                  // reset the form
                  this.handleResetEdit();
                });
  
          },
  
          postDeleteOffer(o) {  
            // this will confirm whether you want to delete the book or not 
            if ( !confirm("Are you sure you want to delete " + o.firstName + "?") ) {
                return;
            }  
            // if they do want to it will do this 
            // this will delete any books in the table 
            console.log("Delete!", o);
            
            fetch('api/ref/delete.php', {
                method:'POST',
                body: JSON.stringify(o),
                headers: {
                  "Content-Type": "application/json; charset=utf-8"
                }
              })
              .then( response => response.json() )
              .then( json => {
                console.log("Returned from post:", json);
                // TODO: test a result was returned!
                this.refs = json;
                
                // reset the form
                this.handleResetEdit();
              });
          },
          // handle edit offer 
          handleEditOffer(offer) {
              this.selectedOffer = offer;
              this.offerForm = Object.assign({}, this.selectedOffer);
          },
          // handle reset edit 
          handleResetEdit() {
              this.selectedOffer = null;
              this.offerForm = {};
          }
      },
    created() {
        this.fetchRefData();
        this.fetchGameData();
        this.fetchAssignmentData();
    }
  
  }
  
  Vue.createApp(SomeApp).mount('#offerApp');