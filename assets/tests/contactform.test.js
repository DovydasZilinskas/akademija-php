import { shallowMount, createLocalVue } from '@vue/test-utils';
import Vuex from 'vuex';
import App from '../views/ContactForm.vue';

const localVue = createLocalVue();

localVue.use(Vuex);

describe('App', () => {
  // let actions
  let getters;
  let store;
  let mutations;

  beforeEach(() => {
    getters = {
      getCurrentName: () => 'Name',
      getCurrentEmail: () => 'Email',
      getCurrentMessage: () => 'Message',
    };
    mutations = {
      updateName: () => 'updateName',
    };
    store = new Vuex.Store({
      getters,
      mutations,
    });
  });

  it('expected?', () => {
    const wrapper = shallowMount(App, { store, localVue });
    expect(wrapper).toMatchSnapshot();
  });

  it('find name field', async () => {
    const wrapper = shallowMount(App, { store, localVue });
    const input = wrapper.find('input[type="text"]');
    await input.setValue('Name');

    const state = {
      name: 'Name',
    };

    expect(wrapper.find('input[type="text"]').element.value).toBe(
      getters.getCurrentName(state)
    );
  });
});
