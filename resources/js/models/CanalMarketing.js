
const list = [
    { id: 1, text: 'Google', },
    { id: 2, text: 'Facebook', },
    { id: 3, text: 'Twitter', },
    { id: 4, text: 'Un amigo', },
]

class CanalMarketing {
    
    constructor( args = {} ) {
        ( { id: this.id = null, text: this.text = null } = args );
    }
 
    findAll () {
        return list.map(e => new CanalMarketing(e));
    }
 
    toString () {
        return 'Public method toString has been called.';
    }
}

export default CanalMarketing