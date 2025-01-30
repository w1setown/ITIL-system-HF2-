
<script>
import axios from 'axios';

export default{
    data() {
        return{
            users: []
        };
    },
    mounted() {
        axios.get('http://localhost/vue_php_api/users.php')
        .then(response =>{
            this.users = response.data;
        })
        .catch(error => {
            console.error("Der var et irriterende problem", error);
        });
    }
};
</script>