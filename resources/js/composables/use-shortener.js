import { ref, computed } from 'vue';
import { isValidUrl } from '@/utils/is-url-valid.js';
import { generateShortLink } from '@/api/links.js';

export const useShortener = () => {
    const form = ref({ url: 'https://' });
    const isBusy = ref(false);
    const response = ref({});
    const errors = ref({ message: '' });

    // Computed properties
    const canSubmitForm = computed(
        () => !isBusy.value && isValidUrl(form.value.url),
    );
    const hasResponse = computed(
        () => Object.keys(response.value || {}).length > 0,
    );
    const hasError = computed(() => errors.value.message.length > 0);

    // Methods
    const clearRequestErrors = () => {
        errors.value.message = '';
    };

    const submit = () => {
        if (!canSubmitForm.value) {
            return;
        }

        clearRequestErrors();

        isBusy.value = true;

        return generateShortLink(form.value.url)
            .then(({ data }) => {
                response.value = data;
                return data;
            })
            .catch((e) => {
                response.value = {};
                errors.value.message =
                    e?.response?.data?.message || 'Something went wrong';
            })
            .finally(() => {
                isBusy.value = false;
            });
    };

    return {
        form,
        isBusy,
        response,
        errors,
        canSubmitForm,
        submit,
        clearRequestErrors,
        hasResponse,
        hasError,
    };
};
