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

        preview.innerHTML = `<form id="preview" method="post"><div class="preview-content"><input type="text" name="title" id="title" class="preview-title" value="${title}"/><textarea name="description" id="description" class="preview-description">${description}</textarea><input type="hidden" name="id" value="${id}"><button type="submit" id="save" name="save">SAVE<button/></div></form>`;
    }
}