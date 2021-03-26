import { mount, createLocalVue } from '@vue/test-utils';
import Vuex from 'vuex';
import App from '../views/ContactForm.vue';
import Notification from '../components/Notification.vue';

const localVue = createLocalVue();

localVue.use(Vuex);

describe('App', () => {
  let getters;
  let store;
  let mutations;

  beforeEach(() => {
    data = {
      error: true,
    };
    getters = {
      getCurrentName: () => 'Name',
      getCurrentEmail: () => 'Email',
      getCurrentMessage: () => 'Message',
    };
    mutations = {
      updateName: () => 'updateName',
      updateEmail: () => 'updateEmail',
      updateEmailMessage: () => 'updateEmailMessage',
    };
    store = new Vuex.Store({
      getters,
      mutations,
    });
  });

  it('leave blank fields', async () => {
    const wrapper = mount(App, { store, localVue });
    const name = wrapper.find('input[type="text"]');
    const notification = wrapper.classes('notification');
    const button = wrapper.find('button');

    await name.setValue('Name');

    console.log(notification);

    await button.trigger('click');

    expect(notification.text()).toContain('Please fill blank fields.');
  });

  it('expected?', () => {
    const wrapper = mount(App, { store, localVue });
    expect(wrapper).toMatchSnapshot();
  });
});
