function getUrlParameters() {
    let url = window.location.href;

    url = url.split("/");
    url = url[url.length - 1];

    return url;
}