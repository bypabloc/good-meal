
class Client {
    
    constructor( args = {} ) {
        ( {
            email: this.email = null,
            names: this.names = null,
            number: this.number = null,
            canal_marketing: this.canal_marketing = null,
            birth_date: this.birth_date = null,
            location: this.location = null,
            observation: this.observation = null,
        } = args );
    }

    checkEmail() {
        return new Promise((resolve, reject) => {
            axios.post(
                `subcribirse/check_email`,
                {
                    email: this.email,
                },
            )
            .then(resolve)
            .catch(reject)
        })
    };

    save() {
        return new Promise((resolve, reject) => {
            axios.post(
                `subcribirse/new`,
                {
                    email: this.email,
                    names: this.names,
                    number: this.number,
                    canal_marketing: this.canal_marketing,
                    birth_date: this.birth_date,
                    location: this.location,
                    observation: this.observation,
                },
            )
            .then(resolve)
            .catch(reject)
        })
    };

    clear() {
        this.email = null;
        this.names = null;
        this.number = null;
        this.canal_marketing = null;
        this.birth_date = null;
        this.location = null;
        this.observation = null;
    };
 
    findAll () {
        return list.map(e => new Client(e));
    }
}

export default Client

/*
export default function() {
    this.email = null;
    this.names = null;
    this.number = null;
    this.canal_marketing = null;
    this.birth_date = null;
    this.location = null;
    this.observation = null;
    
    this.new = function({
        email=null,
        names=null,
        number=null,
        canal_marketing=null,
        birth_date=null,
        location=null,
        observation=null,
    }) {
        this.email = email;
        this.names = names;
        this.number = number;
        this.canal_marketing = canal_marketing;
        this.birth_date = birth_date;
        this.location = location;
        this.observation = observation;
    };
    
    this.clear = function() {
        this.email = null;
        this.names = null;
        this.number = null;
        this.canal_marketing = null;
        this.birth_date = null;
        this.location = null;
        this.observation = null;
    };

    this.form = function() {
        return {
            email,
            names,
            number,
            canal_marketing,
            birth_date,
            location,
            observation,
        }
    };
}
*/
