export const URL_REGEX = /^(https?:\/\/)?([\w.]+\.[a-z]{2,})(\/[^\/]*)*$/i;

export const isValidUrl = (url) => {
    if (url.length < 4) return false;

    return URL_REGEX.test(url);
};
