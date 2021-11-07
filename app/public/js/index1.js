
const SomeApp = {
    data() {
      return {
        students: [],
        selectedStudent: null,
        offers: [],
        offerForm: {},
        gameForm: {},
        books: [],
        refs : [],
        games: [],
        comments: [],
        commentForm: {},
        bookForm: {},
        selectedOffer: null
      }
    },
    computed: {},
    methods: {
      // this fetches the book data from the book api index 
        fetchBookData() {
            fetch('/api/ref/')
            .then(response => response.json())
            .then((parsedJson) => {
                console.log(parsedJson);
                this.refs = parsedJson
            })
            .catch( err => {
                console.error(err)
            })
        },
        // wil post offer 
        postOffer(evt) {
            console.log ("Test:", this.selectedOffer);
          if (this.selectedOffer) {
              this.postEditOffer(evt);
          } else {
              this.postNewOffer(evt);
          }
        },
        postEditOffer(evt) {
          //this.offerForm.bookID = this.selectedOffer.bookID;
          // this.offerForm.studentId = this.selectedStudent.id;     
          
          //console.log("Editing!", this.offerForm);

          // this will update/edit the book
  
          fetch('api/ref/update.php', {
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
          if ( !confirm("Are you sure you want to delete " + o.firstName + "'s Referee Data?") ) {
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
      // fetch the book data 
        this.fetchBookData();
        //this.fetchCommentsData();
    }
  
  }
  
  Vue.createApp(SomeApp).mount('#offerApp');