
class User {
    
    constructor( args = {} ) {
        ( {} = args );
    }

    logout() {
        return new Promise((resolve, reject) => {
            axios.post(`logout`,)
            .then(resolve)
            .catch(reject)
        })
    };

}

export default User
