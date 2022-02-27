<style>
.pluginWrap {
    padding: 20px;
    display: flex;
    flex-direction: column;
}

article {
    margin-bottom: 15px;
    width: 100%;
    min-height: 350px;
    display: flex;
    flex-direction: row;
    overflow: visible;
    border-radius: 15px;
    border: 5px solid #2B2B2B;
}

.videoPreview {
    height: auto;
    width: 100%;
    max-width: 650px;
}

.resultComponents {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: 20px;
    box-sizing: border-box;
}

.resultInfo {
    height: auto;
    overflow: hidden;
    text-overflow: ellipsis;
    border-bottom: 2px solid #2B2B2B;
    border-end-end-radius: 10px;
}

.resultInfo h1 {
    padding: 0;
    font-size: 18pt;
    font-family: 'Alata';
}

.resultInfo span {
    padding: 0;
    font-size: 12pt;
    padding-top: 50px;
    padding-bottom: 50px;
    font-family: 'Montserrat';
}

.resultDynamic {
    width: 100%;
    height: 55%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-top: 15px;
}

.col {
    display: flex;
    flex-direction: row;
    width: 100%;
}

.s1 input.only[type=text] {
    width: 50%;
    margin-right: 15px;
}

.s1 .select-wrapper {
    width: 50%;
}

.input-field {
    margin-top: 0px;
}

.btnArticle {
    width: 100%;
}

.checkedPublish {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btnArticle:hover {
    color: white;
}

.checkbox-red[type="checkbox"].filled-in:checked+span:after {
    border: 2px solid #F44336;
    background-color: #F44336;
}

label input[type=checkbox] {
    display: none;
}

.noneArticleControls {
    display: flex;
    flex-direction: row;

}

.resultsYoutube{
    display: flex;
    flex-direction: column;
    transition: .5s all;
}

.bater{
    display: flex;
    flex-direction: row;
    width: 100%;
}

.hidden{
    display: none;
}

.select-wrapper{
    margin-right: 0;
}

#notPublish{
    display: flex;
    flex-direction: row;
    width: 100%;
}

#isPublish{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-content: center;
    width: 100%;
}

.t2{
    align-items: center;
}

.t2 i{
    cursor: pointer;
    font-size: 25pt;
    margin-left: 25px;
}

.articleResult{
    transition: all 200ms linear;
}

.excludeThis{
    overflow: hidden;
    height: 0px;
    border: none;
    margin: 0;
}

.ajust3-txar{
    min-height: 100px;
    max-height: 160px;
    width: 100%;
    border: #2B2B2B 1px solid;
    border-radius: 10px;
    overflow: auto;
    margin-bottom: 15px;
    font-family: 'Montserrat', sans-serif; 
    font-size: 12pt;
    padding: 15px;
    box-sizing: border-box;
}

.noneArticleControls{
    display: sticky;
}
</style>
<div class="pluginWrap">
    <div class="resultsYoutube">

    </div>
    <div class="noneArticleControls" style="display: none;">
        <a class="waves-effect waves-light btn btnArticle red" id="publishSelection">Publicar seleccion</a>
        <a class="waves-effect waves-light btn btnArticle red" id="prev" style="display:none;">Prev</a>
        <a class="waves-effect waves-light btn btnArticle red" id="next">Next</a>
    </div>
</div>
<template>
    <article class="articleResult">
        <iframe width="1172" height="659" id=rsEmbed src="" class="videoPreview" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <img src="" id="rsThumb" alt="" style="display: none;">
        <div class="resultComponents">
            <div class="resultInfo">
                <div class="col t2">
                    <input type="text" id="rsTitle" value=""></h1>
                    <i class="material-icons" onclick="exclude(this)">clear</i>
                </div>                
                <span style="display: none;" id="rsCommonTitle"></span>
                <span style="display: none;" id="rsCommonId"></span>
                <span id="rsVideoChannel"></span>
                <p id="rsVideoDesc"></p>
            </div>
                <div class="resultDynamic">
                    <div class="col s1">
                        <div id="notPublish">
                            <input type="text" class="only" name="" id="gpUrl" placeholder="Google Play URL">
                            <select class="select-wrapper" id="categories" multiple>
                                <option value="" disabled selected>Seleccione las categorías</option>
                                <?php
                                        foreach(get_categories( array('hide_empty' => 0, 'parent' => 0, 'order'=>'DESC') ) as $category) {
                                            //echo '<li><a href="#" data-filter=".'. $category->slug.'" >' . $category->name.'</a></li>';
                                            if($category->name == "Musica"){
                                                echo '<option value="' . $category->term_id.'" selected>' . $category->name.'</option>';
                                            }
                                            else{
                                                echo '<option value="' . $category->term_id.'">' . $category->name.'</option>';
                                            }
                                        }
                                    ?>
                            </select>
                        </div>   
                        <div id="isPublish">
                            <h1>PUBLICADO</h1>
                        </div>                     
                    </div>
                    <div class="chips" id="tags">

                    </div>
                    <div class="col s4" id="postBody">
                        <textarea contentEditable="true" class="ajust3-txar" placeholder="Cuerpo del articulo" id="postTextarea"></textarea>
                    </div>
                    <div class="col s3" id="resultId">
                        <div class="bater pbBtr" id="pbBtr">
                            <button class="waves-effect waves-light btn btnArticle red" onclick="btnPublish(this)">PUBLICAR SOLO</button>
                            <label class="checkedPublish" id="multibublish" for="multiPublish">
                                <input type="checkbox" class="filled-in checkbox-red selectedArticle" id="multiPublish"/>
                                <span>Publicacion multiple</span>
                            </label>
                        </div> 
                        <div class="bater" id="edBtr">
                            <button class="waves-effect waves-light btn btnArticle red" onclick="btnEdit(this)">EDITAR</button>
                            </label>
                        </div>                       
                    </div>
                </div>
        </div>
    </article>
</template>
<script>
M.AutoInit();

$(function () {
    $("#postTextarea").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        alert(code);
        if (code == 13) {
            alert('Chubaka')
        }
    });
});

let ytApiResponse;

$("#filterDate").on('change', function() {
    ytApiSend();
});

$("#filterOrder").on('change', function() {
    ytApiSend();
});

$('#searchBtn').keypress(function(event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        ytApiSend();
    }
    event.stopPropagation();
});

$( "#next" ).click(function() {
    var publishInformation = [];
    $checkbox = $('.selectedArticle');
    publishInformation = $.map($checkbox, function (el) {
        if (el.checked) { return el.parentNode.parentNode.parentNode.id };
    });     

    ytApiResponse = ytApiResponse[2];

    if(publishInformation.length == 0){
        ytApiSend(ytApiResponse);
    }
    else{
        let e = confirm("Hay elementos seleccionados, si continua perdera la seleccion\n ¿Quiere Continuar?")

        if(e == true){
            ytApiSend(ytApiResponse);
        }
    }
});

$( "#prev" ).click(function() {
    var publishInformation = [];
    $checkbox = $('.selectedArticle');
    publishInformation = $.map($checkbox, function (el) {
        if (el.checked) { return el.parentNode.parentNode.parentNode.id };
    });     

    ytApiResponse = ytApiResponse[3];

    if(publishInformation.length == 0){
        ytApiSend(ytApiResponse);
    }
    else{
        let e = confirm("Hay elementos seleccionados, si continua perdera la seleccion\n ¿Quiere Continuar?")

        if(e == true){
            ytApiSend(ytApiResponse);
        }
    }
});

function btnEdit(e){
    var parentId = e.parentNode.parentNode.id;
    let articleResult = document.getElementById(parentId);
    var articleRealId = articleResult.querySelector("#rsCommonId").innerHTML;

    var url = "<?php getPluginFolder('includes/getPostIdBySlug.php'); ?>";
    var getPostId = {postSlug: articleRealId};

    $.ajax({
        url: url,
        type: "GET",
        data: getPostId,
        success: function(response) {
            window.open("post.php?post="+ response +"&action=edit");
            //console.log("post.php?post="+ response +"&action=edit");
        }
    })
}

function exclude(e){
    var parentId = e.parentNode.parentNode.parentNode.parentNode.id;
    let articleResult = document.getElementById(parentId);
    var articleRealId = articleResult.querySelector("#rsCommonId").innerHTML;
    var articleRealTitle = articleResult.querySelector("#rsCommonTitle").innerHTML;

    var url = "<?php getPluginFolder('includes/editConfig.php'); ?>";

    var readyTransferInformation = {configType: "exclude", titleKey: articleRealTitle,idKey: articleRealId};    

    $.ajax({
            url: url,
            type: "GET",
            data: readyTransferInformation,
            success: function(response) {
                response = JSON.parse(response);
                var parentId = e.parentNode.parentNode.parentNode.parentNode.id;
                let articleResult = document.getElementById(parentId);
                $(articleResult).addClass('excludeThis');
                setTimeout(function(){
                    articleResult.remove();
                }, 200);
                console.log(response);
            }
        })

    
}

function btnPublish(e) {
    //console.log(e);

    var tranferInformation = [];
    var parentId = e.parentNode.parentNode.id;
    var articleLoop = {};
    let articleResult = document.getElementById(parentId);

    //Establecemos los parametros y los obtenemos
    let articleTitle = articleResult.querySelector("#rsTitle").value;
    let articleThumb = articleResult.querySelector("#rsThumb");
    articleThumb = articleThumb.src;
    var instance = M.FormSelect.getInstance($(articleResult.querySelector("#categories")));
    var articleCategories = instance.getSelectedValues();
    var articleTags = M.Chips.getInstance($(articleResult.querySelector("#tags"))).chipsData;
    var articleGpUrl = articleResult.querySelector("#gpUrl").value;
    var articleRealTitle = articleResult.querySelector("#rsCommonTitle").innerHTML;
    var articlePostBody = articleResult.querySelector("#postTextarea").value;
    var articleRealId = articleResult.querySelector("#rsCommonId").innerHTML;

    //Preparamos los parametros para enviarlos
    articleLoop['title'] = articleTitle;
    articleLoop['thumb'] = articleThumb;
    articleLoop['categories'] = articleCategories;
    articleLoop['tags'] = articleTags;
    articleLoop['gpUrl'] = articleGpUrl;
    articleLoop['realTitle'] = articleRealTitle;
    articleLoop['articlePostBody'] = articlePostBody;
    articleLoop['idKey'] = articleRealId;
    var articleTags = articleLoop['tags'];
    var readyTags = [];

    articleTags.forEach(element => {
        var readyElement = element['tag'];

        readyTags.push(readyElement);
    });

    articleLoop['tags'] = readyTags;

    tranferInformation.push(articleLoop);

    var url = "<?php getPluginFolder('includes/publishPost.php'); ?>";

    var readyTransferInformation = {publishInfo: tranferInformation};    

    console.log(readyTransferInformation);

    $.ajax({
        url: url,
        type: "GET",
        data: readyTransferInformation,
        success: function(response) {
            console.log(response);            
            articleResult.querySelector('#pbBtr').style.display = 'none';
            articleResult.querySelector('#tags').style.display = 'none';
            articleResult.querySelector('#postBody').style.display = 'none';
            articleResult.querySelector('#notPublish').style.display = 'none';
            articleResult.querySelector('#edBtr').style.display = 'flex';
            articleResult.querySelector('#isPublish').style.display = 'flex';
        }
    })
}

$( "#publishSelection" ).click(function() {
    $checkbox = $('.selectedArticle');
    var publishInformation = [];    
    var tranferInformation = [];
    var gpUrls = [];
    publishInformation = $.map($checkbox, function (el) {
        if (el.checked) { return el.parentNode.parentNode.parentNode.id };
    });     

    publishInformation.forEach(element => {
        console.log(element);
        var articleLoop = {};
        let articleResult = document.getElementById(element);
        //Establecemos los parametros y los obtenemos
        let articleTitle = articleResult.querySelector("#rsTitle").value;
        let articleThumb = articleResult.querySelector("#rsThumb");
        articleThumb = articleThumb.src;
        var instance = M.FormSelect.getInstance($(articleResult.querySelector("#categories")));
        var articleCategories = instance.getSelectedValues();
        var articleTags = M.Chips.getInstance($(articleResult.querySelector("#tags"))).chipsData;
        var articleGpUrl = articleResult.querySelector("#gpUrl").value;
        var articleRealTitle = articleResult.querySelector("#rsCommonTitle").innerHTML;
        var articlePostBody = articleResult.querySelector("#postTextarea").value;
        var articleRealId = articleResult.querySelector("#rsCommonId").innerHTML;

        //Preparamos los parametros para enviarlos
        articleLoop['title'] = articleTitle;
        articleLoop['thumb'] = articleThumb;
        articleLoop['categories'] = articleCategories;
        articleLoop['tags'] = articleTags;
        articleLoop['gpUrl'] = articleGpUrl;
        articleLoop['realTitle'] = articleRealTitle;
        articleLoop['articlePostBody'] = articlePostBody;
        articleLoop['idKey'] = articleRealId;

        var articleTags = articleLoop['tags'];
        var readyTags = [];

        articleTags.forEach(element => {
            var readyElement = element['tag'];

            readyTags.push(readyElement);
        });

        articleLoop['tags'] = readyTags;

        tranferInformation.push(articleLoop);

        console.log(articleLoop);
    });

    var url = "<?php getPluginFolder('includes/publishPost.php'); ?>";

    var readyTransferInformation = {publishInfo: tranferInformation};    

    console.log(readyTransferInformation);

    $.ajax({
        url: url,
        type: "GET",
        data: readyTransferInformation,
        success: function(response) {
            console.log(response);
            publishInformation.forEach(element => {                
                let captionElement = document.getElementById(element);

                captionElement.querySelector('#pbBtr').style.display = 'none';
                captionElement.querySelector('#tags').style.display = 'none';
                captionElement.querySelector('#postBody').style.display = 'none';
                captionElement.querySelector('#notPublish').style.display = 'none';
                captionElement.querySelector('#edBtr').style.display = 'flex';
                captionElement.querySelector('#isPublish').style.display = 'flex';
            });
        }
    })
});

function ytApiSend(pageToken = "") {
    var ytSearch = $("#searchBtn").val();
    var eDate = document.getElementById("filterDate");
    var eOrder = document.getElementById("filterOrder");
    var ytFilterDate = eDate.options[eDate.selectedIndex].id;
    var ytFilterOrder = eOrder.options[eOrder.selectedIndex].id;

    var url = "<?php getPluginFolder('includes/ytApiReturner.php'); ?>";
    var ytApiData = {
        ytApiSearch: ytSearch,
        ytApiFilterDate: ytFilterDate,
        ytApiFilterOrder: ytFilterOrder,
        pageToken: pageToken
    };    

    //alert(ytSearch + " " + ytFilter);

    $.ajax({
        url: url,
        type: "GET",
        data: ytApiData,
        success: function(response) {
            ytApiResponse = JSON.parse(response);

            console.log(ytApiResponse);

            $(".resultsYoutube").empty();

            let resultId = -1;

            var resultsApi = JSON.parse(ytApiResponse[0]);
            var isPostExsist = ytApiResponse[1];
            var isExculded = ytApiResponse[2]
            var prevPageExsist = ytApiResponse[4];

            resultsApi.forEach(element => {
                resultId++;
                var postExclude = isExculded[resultId];  
                let videoTitle = element["snippet"]["title"];
                let videoChannel = element["snippet"]["channelTitle"];
                let videoDescription = element["snippet"]["description"];
                let videoThumb = element["snippet"]["thumbnails"]["high"]["url"];
                let videoUrl = 'https://www.youtube.com/watch?v=' + element["id"]["videoId"];
                let videoEmbed = 'https://www.youtube.com/embed/' + element["id"]["videoId"];
                var postExsist = isPostExsist[resultId];                

                var temp = document.getElementsByTagName("template")[0];

                temp.content.getElementById("rsTitle").value = videoTitle;
                temp.content.getElementById("rsVideoChannel").innerHTML = videoChannel;
                temp.content.getElementById("rsCommonTitle").innerHTML = videoTitle;
                temp.content.getElementById("rsEmbed").src = videoEmbed;
                temp.content.getElementById("rsVideoDesc").innerHTML = videoDescription;
                temp.content.getElementById("rsThumb").src = videoThumb;
                temp.content.getElementById("rsCommonId").innerHTML = element["id"]["videoId"];
                temp.content.querySelector(".selectedArticle").id = 'publishselection'+resultId;
                temp.content.getElementById("multibublish").setAttribute("for", 'publishselection'+resultId);

                if(postExsist == "true"){      
                    console.log("Post Exsist");
                    temp.content.getElementById("pbBtr").style.display = "none";
                    temp.content.getElementById("tags").style.display = "none";
                    temp.content.getElementById("postBody").style.display = "none";
                    temp.content.getElementById("notPublish").style.display = "none";
                    temp.content.getElementById("edBtr").style.display = "flex";
                    temp.content.getElementById("isPublish").style.display = "flex";                    
                }
                else{
                    console.log("Post Not Exsist");
                    temp.content.getElementById("pbBtr").style.display = "flex";
                    temp.content.getElementById("tags").style.display = "flex";
                    temp.content.getElementById("postBody").style.display = "flex";
                    temp.content.getElementById("notPublish").style.display = "flex";
                    temp.content.getElementById("edBtr").style.display = "none";
                    temp.content.getElementById("isPublish").style.display = "none";             
                }
                temp.content.querySelector(".s3").id = resultId;
                temp.content.querySelector(".articleResult").id = resultId;                

                var clon = temp.content.cloneNode(true);
                if(postExclude != "true"){
                    $(".resultsYoutube").append(clon);
                }                

                $(".noneArticleControls").css("display", "flex")
                if(prevPageExsist != null){
                    document.getElementById("prev").style.display = 'block';
                }
                //Debug Control
                console.log(videoTitle);
                console.log(postExsist);
            });            

            M.AutoInit();
        }
    })
}

console.log(ytApiResponse);
</script>