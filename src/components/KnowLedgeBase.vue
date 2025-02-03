<template>
    <div>
        <h2>FaQ</h2>
        <div class="content">
            <h3> {{ title }} </h3>    
            <ul>
                <li v-for="content in content" :key="content.id"> {{ content.content }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            content: []
        };
    },
    mounted() {
        axios.get('http://localhost/ITIL-system-HF2-/backend/knowledgebase.php')
        .then(response => {
            this.title = response.data.title; 
            this.content = response.data.content;
            console.log("Content fetched:", this.content);
        })
        .catch(error => {
            console.error("Error fetching data:", error.response ? error.response.data : error.message);
        });
    }
}
</script>



<style>
/*::content {
    
}

*/
</style>
