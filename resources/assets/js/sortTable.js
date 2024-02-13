document.getElementById("books-table").addEventListener("click", function (event) {
    if (event.target.tagName === "TH" || event.target.parentElement.tagName === "TH") {
        let thElement = event.target.tagName === "TH" ? event.target : event.target.parentElement;
        let colIndex = thElement.cellIndex;
        sortTable(colIndex);
    }
    if (event.target.classList.contains('openModalBtn')) {
        // event.target.nextElementSibling.style.display = 'block';
    }
});

const modalWindows = document.querySelectorAll('.modalWindow');

modalWindows.forEach(function (modalWindow) {
    modalWindow.addEventListener('click', function (event) {
        if (event.target.classList.contains('closeModal') || !modalWindow.contains(event.target)) {
            modalWindow.previousElementSibling.style.display = 'none';
        }
    });
});



function sortTable(colIndex) {
    if (colIndex === 0 || colIndex === 7) {
        return;
    }

    let table = document.getElementById("books-table");
    let rows = table.rows;
    let switching = true;
    let shouldSwitch;
    let direction = "asc"; // ascending by default
    let switchcount = 0;

    while (switching) {
        switching = false;
        let i = 1;
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            let x, y;
            if (colIndex === 6) {
                x = getDateValue(rows[i].getElementsByTagName("td")[colIndex].innerHTML);
                y = getDateValue(rows[i + 1].getElementsByTagName("td")[colIndex].innerHTML);
            } else {
                x = rows[i].getElementsByTagName("td")[colIndex].innerHTML;
                y = rows[i + 1].getElementsByTagName("td")[colIndex].innerHTML;
            }
            // Convert x and y to numbers if they are numeric
            if (!isNaN(parseFloat(x)) && !isNaN(parseFloat(y))) {
                x = parseFloat(x);
                y = parseFloat(y);
            }

            if (direction === "asc") {
                if (x > y) {
                    shouldSwitch = true;
                    break;
                }
            } else if (direction === "desc") {
                if (x < y) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount === 0 && direction === "asc") {
                direction = "desc";
                switching = true;
            }
        }
    }
}

function getDateValue(dateString) {
    return new Date(dateString.replace(/-/g, '/')).getTime();
}