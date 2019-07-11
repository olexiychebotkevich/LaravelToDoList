<template>
<div>
<li @click="checkTask" v-bind:class="{ checked:  this.task.done == 'true' }">{{task.text}}<span @click="removeItem" class="close">&times;</span></li>
</div>
</template>



<script>



    export default { 


 data:()=>({
        isDone: false,
        }),
      
        props:['task'],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
         removeItem: function() {
        // генерируем событие 'remove' и передаём id элемента
        this.$emit('remove', this.task.id);
        }, 
       
        checkTask:function() {
        //    if(this.isDone==false)
        //    this.isDone=true;
        //    else
        //    this.isDone=false;

              this.task.done = this.task.done == "true" ? "false" : "true";
              axios.post('/checkdone',{id:this.task.id,done:this.task.done}).then((response)=>{
              console.log('task updated.')
             })

        }

        },
     
    }
</script>



<style>

 li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;

  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
 li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
 li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
 li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}
</style>