import {createStore} from 'vuex'
import i18n from "@/assets/js/i18n";

export default createStore(
    {
        state    : {
            // return: {
            user_id: JSON.parse(localStorage.getItem('token')).id,
            // lang   : i18n.locale,
            // lang   : this.$i18n.locale,
            // }
        },
        getters  : {},
        mutations: {},
        actions  : {},
        modules  : {}
    }
)
