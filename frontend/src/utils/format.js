// utils.js
export const removeDecimalPlaces = (str) => {
    return str.replace(/(\.\d+)?x/g, 'x').replace(/\.00/g, '');
};

export const formatSize = (size) => {
    return size.replace(/\.00/g, '');
};