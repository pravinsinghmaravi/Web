function AddSearch(query) {

    document.write('<a id="anchor" href='+query+'><h1>your Site</h1></a>');
}
var query = (new URLSearchParams(window.location.search)).get('search');
if(query) {
    AddSearch(query);
/* console.log(query); */
}