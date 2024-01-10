import { describe, expect, it } from 'vitest';
import { mount } from '@vue/test-utils';
import Button from '@/components/ui/Button.vue';

const BUTTON_SELECTOR = '[data-testid=button]';

describe('Button Component', () => {
    it('renders a button and emits click event', async () => {
        const wrapper = mount(Button, {
            props: { disabled: false },
            slots: { default: 'Click me' },
        });

        expect(wrapper.find(BUTTON_SELECTOR).text()).toBe('Click me');
        expect(wrapper.attributes('disalbed')).toBeUndefined()

        await wrapper.find(BUTTON_SELECTOR).trigger('click');
        expect(wrapper.emitted().click).toBeTruthy();
    });

    it('renders disabled state button and does not emit click event', async () => {
        const wrapper = mount(Button, {
            props: { disabled: true },
            slots: { default: 'Click me' },
        });

        const button = await wrapper.find(BUTTON_SELECTOR);
        expect(button.attributes('disabled')).toBeDefined();
        await button.trigger('click');
        expect(wrapper.emitted().click).toBeFalsy();
    });
});
