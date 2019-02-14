<template>
  <div>
    <h1>contact</h1>
    <form action="#" @submit.prevent = "edit ? updatecontact(contact.id) : createcontact()" class="col-md-6">
      <div class="form-group">
        <label>Name</label>
        <input v-model="contact.name" type="text" name="name" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input v-model="contact.email" type="text" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label>Phone</label>
        <input v-model="contact.phone" type="text" name="phone" class="form-control">
      </div>
      <div class="form-group">
        <input v-show="!edit" type="submit" class="btn btn-primary" value="Send">
        <input v-show="edit" type="submit" class="btn btn-success" value="Edit">
      </div>
    </form>
    <h1> Contact List </h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="contact in list">
        <span> {{contact.name}}  </span>
        <span>[ {{contact.email}} ]</span>
        <span> {{contact.phone}} </span>
        <button @click="showContact(contact.id)" class="btn btn-info btn-xs">Edit</button>
        <button @click="deleteContact(contact.id)" class="btn btn-danger btn-xs">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
  export default{
    data: function(){
      return {
        edit: false,
        list:[],
        contact:{
          id:'',
          name:'',
          email:'',
          phone:'',
        }
      }
    },
    mounted: function(){
      this.fetchContactList();
    },
    methods:{

      fetchContactList: function(){
        axios.get('/api/contacts')
          .then((response) => {
            this.list = response.data;
          })
          .catch((error) => {
            return console.log(error);
          });
      },

      createcontact: function(){
        let self = this;
        let params = Object.assign({}, self.contact);
        axios.post('/api/contact/store', params)
          .then(function(){
            self.contact.name = '',
            self.contact.email = '',
            self.contact.phone = '',
            self.edit = false,
            self.fetchContactList()
          })
          .catch(function(error){
            console.log(error);
          });
      },

      showContact: function(id){
        let self = this;
        axios.get('api/contact/'+id)
          .then(function(response){
            self.contact.id = response.data.id;
            self.contact.name = response.data.name;
            self.contact.email = response.data.email;
            self.contact.phone = response.data.phone
          })
          self.edit = true;
      },

      updatecontact: function(id){
        console.log('updating => '+ id);
        let self = this;
        let params = Object.assign({}, self.contact);
        axios.patch('/api/contact/'+id, params)
          .then(function(){
            self.contact.name = '',
            self.contact.email = '',
            self.contact.phone = '',
            self.edit = false,
            self.fetchContactList()
          })
          .catch(function(error){
            console.log(error);
          });
      },

      deleteContact: function(id){
        let self = this;
        axios.delete('api/contact/'+id)
          .then(function(response){
            self.fetchContactList();
            console.log("deleted");
          })
          .catch(function(error){
            console.log(error);
          });
      }
    }
  }
</script>
