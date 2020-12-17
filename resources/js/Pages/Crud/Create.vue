<template> 
<form class="p-10"  @submit.prevent="store">


    <div class="mt-2"> 
        <video-input v-model="form.video" :error="$page.errors.video" class="pr-6 pb-8 w-full " type="file" accept="video/*" label="Video" />
    </div>      

    <div class="mt-2"> 
        <file-input 
            v-model="form.image" 
            :preview_img="form.image" 
            :defualt_preview_img="form.text" 
            :error="$page.errors.image" 
            class="pr-6 pb-8 w-full w-full px-5 py-4 text-gray-700 bg-gray-100 rounded " 
            type="file" 
            accept="image/*" 
            label="Image" 
            :preview="true"/>
        </div>               
    </div>      

    <div class="mt-2">
        <text-input 
            id="name" 
            type="text" 
            class="w-full   md:mb-0" 
            :fixedClasses="'right-3 z-50'" 
            v-model="form.text" 
            :error="$page.errors.text"
            label='Some Text'    
            :labelRequire='true'    
        placeholder="some text" />                                         
    </div>       

    <div class="flex items-center justify-end py-3 text-right sm:px-6">
        <loading-button :loading="sending" class="w-full flex items-center justify-center uppercase transition duration-700 ease-in-out bg-green-400 hover:bg-green-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow inline-flex items-center" type="submit" as="button">
            <span>{{Edit?'update':'save'}}</span>
            <svg v-if="!sending"  class="transition duration-700 ease-in-out  h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>                
        </loading-button>          
    </div>    
    <div class="flex items-center justify-end py-3 text-right sm:px-6" v-if="Edit">

        <BackButton class="w-full justify-center"/>
             
    </div>    
 
</form>  
</template>
<script>
import LoadingButton from './../Shared/LoadingButton' 
import BackButton from './../Shared/BackButton' 
import TextInput from './../Shared/TextInput' 
import FileInput from './../Shared/FileInput' 
import VideoInput from './../Shared/FileInputSecondary' 
export default {
    components:{
      LoadingButton, 
      BackButton, 
      TextInput,
      FileInput,
      VideoInput,
    },    
    data() {
        return {
            form:{
                text:this.$page.post?this.$page.post.text:null, 
                image:this.$page.post?this.$page.post.photo_url:null,  
                video:this.$page.post?this.$page.post.video:null,  
            },
            sending:false,
        }
    },
    remember: 'form',

    methods: {
      store(){
            const self = this;
            let formData = new FormData();
            formData.append("text", self.form.text || '')
            formData.append("image", self.form.image || '')
            formData.append("video", self.form.video || '')
            if(this.$page.post){
                formData.append('_method', 'put')
            }
            self.$inertia.post(this.$page.post?route('post.update',this.$page.post.id):route('post.store'), formData, {
                preserveState: true,       
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
                onSuccess: () => {
                    if (Object.keys(this.$page.errors).length === 0) {
                        this.form.text = null
                        this.form.image = null
                        this.form.video = null
                    }
                },             
            })
 
      },
  
    },
    computed:{
        errors(){
          return this.$page.errors;
        }, 
        Edit(){
          return this.$page.post?true:false;
        }, 
    },        
 

       
}
</script>