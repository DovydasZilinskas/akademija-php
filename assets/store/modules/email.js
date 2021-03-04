const state = () => ({
    searchName: "",
    searchEmail: "",
    searchMessage: "",
    searchDateFrom: "",
    searchDateTo: "",
})

const getters = {
    getCurrentSearchName: state => state.searchName,
    getCurrentSearchEmail: state => state.searchEmail,
    getCurrentSearchMessage: state => state.searchMessage,
    getCurrentSearchDateFrom: state => state.searchDateFrom,
    getCurrentSearchDateTo: state => state.searchDateTo,
}

const actions = {}

const mutations = {
    updateSearchName (state, searchName) {
        state.searchName = searchName;
    },
    updateSearchMessage (state, searchMessage) {
        state.searchMessage = searchMessage;
    },
    updateSearchEmail (state, searchEmail) {
        state.searchEmail = searchEmail;
    },
    updateSearchDateFrom (state, searchDateFrom) {
        state.searchDateFrom = searchDateFrom;
    },
    updateSearchDateTo (state, searchDateTo) {
        state.searchDateTo = searchDateTo;
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}