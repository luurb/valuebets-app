//Function prevent user from checking two checkboxes
//in the same row
export function checkboxSwitch(e) {
    if (e.target.tagName == 'INPUT') {
        let parent = e.target.parentNode.parentNode;
        let checkbox = parent.querySelectorAll('input');
        let checkboxLength = checkbox.length;

        for (let i = 0; i < checkboxLength; i++) {
            let box = checkbox[i];
            if (box !== e.target && box.checked) {
                box.checked = box.checked ? false : true;
            }
        }
    }
}
