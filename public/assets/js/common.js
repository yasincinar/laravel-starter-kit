/**
 * Created by yasincinar on 11/07/16.
 */

//It makes first letter of text upper and the others lower
function firstLetterUpper(text) {
    return text.charAt(0).toUpperCase() + text.substr(1).toLowerCase();
}