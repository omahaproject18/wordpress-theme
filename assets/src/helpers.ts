export function updateStyles(element, customProperties) {
    for (let varName in customProperties) {
        if (customProperties[varName] !== "var(--)") {
            element.style.setProperty(varName, customProperties[varName]);
        }
    }
    return true;
}
