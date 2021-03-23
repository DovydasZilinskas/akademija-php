import { mount } from '@vue/test-utils';
import App from '../components/Notification.vue';

describe('Mounted Notification', () => {
  const wrapper = mount(App, {
    propsData: {
      message: 'Message',
    },
  });

  it('renders the correct message', () => {
    expect(wrapper.find('.notification').text()).toContain('Message');
  });

  it('has close button', () => {
    expect(wrapper.find('span').text()).toContain('×');
  });

  it('renders correctly', () => {
    const wrapper = mount(App);
    expect(wrapper.element).toMatchSnapshot();
  });
});
