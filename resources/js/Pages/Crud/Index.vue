<template>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-3 sm:px-20 bg-white border-b border-gray-200">
                <div class="mt-2 text-2xl text-gray-400">List</div>
            </div>
        
            <div class="flex justify-center">
                <div class="w-full pl-0 lg:pl-2">
                    <div class="leading-loose ">

                        <div class="flex flex-wrap -mx-3 mb-2">
                    
                            <div class="w-full md:w-1/2 px-3  md:mb-0">

                                <Create/>
       
                            </div>  

                            <div class="w-full md:w-1/2 px-3  md:mb-0">

                                <List/>
 
                            </div>      

                        </div>   
                        
                    </div>
                </div>    
            </div>    
                    
        </div>
    </div>
</div>
 
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Create from './Create'  
import List from './List'  

 
import LoadingButton from './../Shared/LoadingButton' 
import TextInput from './../Shared/TextInput' 
import FileInput from './../Shared/FileInput' 

export default {
    layout: AppLayout,

    components:{
        Create,
        List,
        LoadingButton, 
        TextInput,
        FileInput,
    },

    
}
</script>