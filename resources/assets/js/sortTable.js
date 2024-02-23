document.querySelector(".sortable").addEventListener("click", function (event) {
    let thElement = event.target.tagName === "TH" ? event.target : event.target.closest("th");
    if (thElement && (thElement.querySelector('div') || thElement.querySelector('svg'))) {
        let colIndex = thElement.cellIndex;
        sortTable(colIndex);
    }
});

function sortTable(colIndex, direction = "asc") {
    let table = document.querySelector(".sortable");
    let rows = table.rows;
    let switching = true;
    let shouldSwitch;
    let switchcount = 0;

    while (switching) {
        switching = false;
        let i, x, y;
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;

            // console.log(rows[i].getElementsByTagName("td")[colIndex].firstChild.tagName);
            if (rows[i].getElementsByTagName("td")[colIndex].querySelector('select')) {
                console.log(rows[i].getElementsByTagName("td")[colIndex].querySelector("select")[0].value);
                x = rows[i].getElementsByTagName("td")[colIndex].querySelector("select").value;
                y = rows[i + 1].getElementsByTagName("td")[colIndex].querySelector("select").value;
            } else {
                x = rows[i].getElementsByTagName("td")[colIndex].innerHTML;
                y = rows[i + 1].getElementsByTagName("td")[colIndex].innerHTML;
            }

            const dateFormatRegex = /^\d{4}-\d{2}-\d{2}$/;
            const isDateFormat = dateFormatRegex.test(x) && dateFormatRegex.test(y);

            if (isDateFormat) {
                x = getDateValue(x);
                y = getDateValue(y);
            }
            else if (!isNaN(parseFloat(x)) && !isNaN(parseFloat(y))) {
                x = parseFloat(x);
                y = parseFloat(y);
            } else {
                x = x.toLowerCase();
                y = y.toLowerCase();
            }

            if ((direction === "asc" && x > y) || (direction === "desc" && x < y)) {
                shouldSwitch = true;
                break;
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