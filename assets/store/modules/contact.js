const state = () => ({
    notificationsMessages: [
        { key: "success", notification: "Message has been sent"},
        { key: "error", notification: "Server error!"},
        { key: "data.fullName", notification: "Name field should not be blank."},
        { key: "data.email", notification: "Email field should not be blank."},
        { key: "data.message", notification: "Message field should not be blank."},
        { key: "blank.fields", notification: "Please fill blank fields."},
     ],
     chosenMessage: '',
     email: "",
     name: "",
     emailMessage: "",
})

const getters = {
    messageToDisplay(state){
        return state.chosenMessage;
    },
    getCurrentName: state => state.name,
    getCurrentEmail: state => state.email,
    getCurrentMessage: state => state.emailMessage,
}

const actions = {}

const mutations = {
    success(state, key){
        const msgResult = state.notificationsMessages.find(msg => {
           return msg.key == key;
        });
        state.chosenMessage = msgResult.notification;
    },
    error(state, key){
        const msgResult = state.notificationsMessages.find(msg => {
           return msg.key == key;
        });
        state.chosenMessage = msgResult.notification;
    },
    updateName (state, name) {
        state.name = name;
    },
    updateEmailMessage (state, emailMessage) {
        state.emailMessage = emailMessage;
    },
    updateEmail (state, email) {
        state.email = email;
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}