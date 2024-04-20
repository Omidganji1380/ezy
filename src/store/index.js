import {createStore} from 'vuex'
import i18n from "@/assets/js/i18n";
import {useStorage} from "@vueuse/core";

export default createStore(
    {
        state    : {
            user_id: JSON.parse(localStorage.getItem('token')).id,
            langu  : localStorage.getItem('lang'),
        },
        getters  : {},
        mutations: {},
        actions  : {},
        modules  : {}
    }
)
