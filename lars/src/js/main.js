import {BootstrapComponents} from '/p4e/src/js/BootstrapComponents.js'

const navSearchbar = document.querySelector('#nav-searchbar');
function setupNavSearch(onResults) {
    const msDebounce = 300;

    if (navSearchbar) {
        let debounceTimer = null;

        navSearchbar.addEventListener('input', () => {
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(async () => {
                const navSearchVal = navSearchbar.value.trim();
                if (navSearchVal) {
                    const fetchURL = encodeURIComponent(navSearchVal);
                    try {
                        const response = await fetch(`src/functions/search.php?title=${fetchURL}`);
                        if (!response.ok) throw new Error(`HTTP ${response.status}`);
                        const data = await response.json();
                        onResults(data);
                    } catch (err) {
                        console.error('Fetch error:', err);
                        onResults(null);
                    }
                }
            }, msDebounce);
        });

    }
}

async function fillSearchTable() {
    const tbody = gameTable.querySelector('tbody');
    const data = await search();

    if (!data.success) {
        console.error("Error while attempting to search.");
        return;
    }
    if (tbody == null) {
        console.error("tbody not found");
        return;
    }

    const createRow = (id, title, price) =>
        `
        <tr data-id="${id}">
            <th scope="col">
                <button data-action="edit">Edit</button>
                <button data-action="del">Delete</button>
                ${id}
            </th>
            <td>${title}</td>
            <td>${price ?? '0.00'}</td>
        </tr>
        `


    tbody.replaceChildren();
    for (const game of data.data) {
        tbody.innerHTML += createRow(game.game_id, game.title, game.price)
    }
    document.querySelector('#search-results-counter > span').innerHTML = Object.keys(data.data).length.toString();
}


const searchFetch = (query) => fetch(`src/functions/search.php?title=${encodeURIComponent(query)}`)


async function search() {
    if (gameTable != null && searchpageSearchbar != null) {
        const searchVal = searchpageSearchbar.value
        const response = await searchFetch(searchVal);

        return response.ok
            ? {success: true, data: await response.json()}
            : {success: false}

    }
}

const gameTable           = document.querySelector('#game-table');
const searchpageSearchbar = document.querySelector('#searchpage-searchbar')
if (location.pathname.endsWith('search_page.php')) {
    const searchbar = document.querySelector('#searchpage-searchbar');
    const URLParams = new URLSearchParams(window.location.search)

    if (URLParams.get('search') !== null) {
        searchbar.value = URLParams.get('search');
    }
    fillSearchTable();
}


setupNavSearch((results) => {
    console.clear();
    console.log('New results:', results);
});


searchpageSearchbar.addEventListener('input', fillSearchTable)

const deleteModal = (title, id) => BootstrapComponents.createModal({
    title: `Do you wish to delete <b>${title}</b>?`,
    body:  `This action is permanent and cannot be undone.<br> Press <kbd style="background-color: var(--bs-danger)">Proceed</kbd> to confirm the deletion of <b>${title}(${id})</b>`,
    haveConfirm: true,
    confirmText: "Proceed",
    confirmColor: "danger",
    dismissText: "Nevermind",
})


gameTable.addEventListener('click', (event) => {
    const button = event.target.closest('button[data-action]');
    const row    = event.target.closest('tr[data-id]');
    if (!button || !row) return;

    const action = button.dataset.action;
    const id = row.dataset.id;

    if (action === 'del') {
        deleteModal(row.cells[1].innerText, id)
    }

})