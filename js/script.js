let selectedElement = null;

function selectTodo(id, title, description, done) {
    let element = document.getElementById(id)
    if (selectedElement !== element.id) {
        if (selectedElement != null) {
            let selected = document.getElementsByClassName("selected-todo")[0];
            selected.classList.remove("selected-todo");
        }
        element.classList.add("selected-todo");
        selectedElement = element.id;
        let preview = document.getElementById("preview");


        preview.innerHTML = `<div class="preview-content"><h1>${title}</h1><p>${description}</p></div>`;
    }
}
