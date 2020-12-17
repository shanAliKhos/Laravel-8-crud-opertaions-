<template>
    <div>
 

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <List/>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import List from './Crud/Index' 

    export default {
        layout: AppLayout,

        components: {
            List,
        },
    }
</script>
