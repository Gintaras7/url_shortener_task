import { describe, expect, it } from 'vitest';
import { mount } from '@vue/test-utils';
import InputField from '@/components/ui/InputField.vue';

const INPUT_FIELD_SELECTOR = '[data-testid=input]';
const LABEL_SELECTOR = '[data-testid=label]';

describe('Input Component', () => {
    it('renders a input field', async () => {
        const wrapper = mount(InputField, {
            props: {
                label: 'Test Label',
                modelValue: 'Initial Value',
                type: 'text',
                'onUpdate:modelValue': (e) =>
                    wrapper.setProps({ modelValue: e }),
            },
        });

        expect(wrapper.find(LABEL_SELECTOR).text()).toBe('Test Label');
        expect(wrapper.props().modelValue).toBe('Initial Value');

        await wrapper.find(INPUT_FIELD_SELECTOR).setValue('New Value');

        expect(wrapper.emitted('update:modelValue')).toBeTruthy();
        expect(wrapper.emitted('update:modelValue')[0][0]).toBe('New Value');
        expect(wrapper.props().modelValue).toBe('New Value');
    });
});
