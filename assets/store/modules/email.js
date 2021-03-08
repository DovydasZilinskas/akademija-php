const state = () => ({
  searchName: '',
  searchEmail: '',
  searchMessage: '',
  searchDateFrom: '',
  searchDateTo: '',
  current: 1,
  pageCount: '',
});

const getters = {
  getCurrentSearchName: (state) => state.searchName,
  getCurrentSearchEmail: (state) => state.searchEmail,
  getCurrentSearchMessage: (state) => state.searchMessage,
  getCurrentSearchDateFrom: (state) => state.searchDateFrom,
  getCurrentSearchDateTo: (state) => state.searchDateTo,
  getCurrentPage: (state) => state.current,
  getPageCount: (state) => state.pageCount,
};

const actions = {};

const mutations = {
  updateSearchName(state, searchName) {
    state.searchName = searchName;
  },
  updateSearchMessage(state, searchMessage) {
    state.searchMessage = searchMessage;
  },
  updateSearchEmail(state, searchEmail) {
    state.searchEmail = searchEmail;
  },
  updateSearchDateFrom(state, searchDateFrom) {
    state.searchDateFrom = searchDateFrom;
  },
  updateSearchDateTo(state, searchDateTo) {
    state.searchDateTo = searchDateTo;
  },
  updatePageCount(state, pageCount) {
    state.pageCount = pageCount;
  },
  updatePage(state, current) {
    if (current > state.pageCount && current != '') {
      state.current = state.pageCount;
    } else if (current != '') {
      state.current = current;
    } else {
      state.current = 1;
    }
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
