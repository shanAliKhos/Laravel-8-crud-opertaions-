<template>
    <div class="my-8 p-10 bg-white rounded shadow-2xl">
        <p class="pb-6 flex font-semibold text-xl text-gray-400">Listing</p>    
        <table class="border-collapse w-full table-auto ">
            <thead>
                <tr>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">#</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Image</th> 
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Text</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">video</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">action</th>
                </tr>
            </thead>
            <tbody> 
                <list-item v-for="(Post, PostIndex) in Posts" :key="PostIndex" :post_index="PostIndex" :post="Post" ></list-item>
         
                <tr v-if="(!Posts.length > 0)" class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td colspan="7" class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b border-gray-300 block lg:table-cell relative lg:static ">
                        <p class="py-5 lg:p-1 text-lg text-gray-300 text-semibold uppercase inline-flex items-center"> 
                            <svg class="h-10 w-10 mr-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>                        
                            <span>No Record Found !  </span>
                        </p>
                    </td> 
                </tr>                                   

            </tbody>
        </table>    
    </div> 
</template>
<script>
import ListItem from "./ListItem"
export default {
    components: {
        ListItem,
    },
    computed:{
        Posts(){
            return this.$page.posts.data;
        },
    },    
}
</script>