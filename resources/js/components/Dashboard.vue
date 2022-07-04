<template>
    <h3>Hai, Ini adalah halaman dashboad {{data?data.title:''}}</h3>
    {{data?data.message:''}}
</template>

<script>
import axios from 'axios'

    export default {
        name:'dashboard',
        data(){
            return {
                data:null
            }
        },  
        mounted(){
            axios.get('api/test').then(result=>{
                this.data = result.data.data
            })
        }
    }
</script>