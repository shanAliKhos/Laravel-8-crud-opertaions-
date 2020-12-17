<template>
  <div>
    <label v-if="label" class="form-label">{{ label }}:</label>
    <div class="form-input p-0" :class="{ error: error }">
      <input ref="file" type="file" :accept="accept" class="hidden" @change="change">
      <div v-if="!value" class="p-2">
        <button type="button" class="mt-2 mr-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150" @click="browse">
          Add Video
        </button>
      </div>
      <div v-else class="flex items-center justify-between p-2">
        <div class="flex-1 pr-1">{{ value.name }} <span class="text-gray-500 text-xs">({{ filesize(value.size) }})</span></div>
        <button type="button" class="mt-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150" @click="remove">
          Remove
        </button>
      </div>
    </div>
    <p class=" text-red-500 text-xs italic" v-if="error">{{error}}</p>                        
    
  </div>
</template>

<script>
export default {
  props: {
    value:null,
    label: String,
    accept: String,
    error:String,
    
  },
  watch: {
    value(value) {
      if (!value) {
        this.$refs.file.value = ''
      }
    },
  },
  methods: {
    filesize(size) {
      var i = Math.floor(Math.log(size) / Math.log(1024)) 
      return (size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
    },
    browse() {
      this.$refs.file.click()
    },
    change(e) { 
      this.$emit('input', e.target.files[0])
    },
    remove() {
      this.$emit('input', null)
    },
  },
}
</script>
