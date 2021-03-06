<?php 

	HtmlHelper::registerCssAndScriptsFiles( array('/css/timeline2.css','/css/news/index.css',
		
											) , Yii::app()->theme->baseUrl. '/assets');


	$cssAnsScriptFilesModule = array(
		'/js/news/index.js',
		'/js/news/autosize.js',
		'/js/news/newsHtml.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath ,
                                "type" => @$type,
                                "page" => "live") ); 
?>
<style>
	
</style>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white top-page no-padding" id="" style="padding-top:0px!important;">
	<?php
        $this->renderPartial($layoutPath.'breadcrum_communexion', array("type"=>@$type)); 
    ?>
    
	<div class="col-lg-1  hidden-md col-sm-1 hidden-xs"></div>
	<div class="col-lg-2 col-md-3 hidden-sm col-xs-12 padding-20 text-right hidden-xs" id="sub-menu-left">
		
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 no-padding margin-top-10">
		<h4 class="text-dark padding-bottom-5 margin-top-25 text-center">
			<i class="fa fa-angle-down"></i> Le fil d'actus
			<i class="fa fa-angle-right hidden fa-title-list"></i> <span class="letter-blue label-category"><i class="fa fa-"></i> </span>
		</h4>
		<hr>

		

		<div id="newsstream"></div>
	</div>	

	<div class="pull-right col-lg-3 col-md-3 col-sm-4 hidden-xs padding-20 margin-top-50" id="nowList">
	
	</div>
</div>



<?php //$this->renderPartial('../news/modalCreateAnc'); ?>

<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"annonces")); ?>

<script type="text/javascript" >

<?php  $parent = Person::getById(@Yii::app()->session["userId"]); ?>


var indexStepInit = 5;
var searchType = ["organizations", "projects", "events", "needs"];
var allNewsType = ["news"];//, "idea", "question", "announce", "information"];

var liveTypeName = { "news":"<i class='fa fa-rss'></i> Les messages",
					 //"idea":"<i class='fa fa-info-circle'></i> Les idées",
					 //"question":"<i class='fa fa-question-circle'></i> Les questions",
					 //"announce":"<i class='fa fa-ticket'></i> Les annonces",
					 //"information":"<i class='fa fa-newspaper-o'></i> Les informations"
					};


var liveScopeType = "global";

<?php if(@$type && !empty($type)){ ?>
	searchType = ["<?php echo $type; ?>"];
<?php }else{ ?>
	searchType = $.merge(allNewsType, searchType);
<?php } ?>

var loadContent = '<?php echo @$_GET["content"]; ?>';
jQuery(document).ready(function() {

	$(".subsub").hide();

	var liveType = "<?php echo (@$type && !empty($type)) ? $type : ''; ?>";
	if(typeof liveTypeName[liveType] != "undefined") 
		 liveType = " > "+liveTypeName[liveType];
	else liveType = ", la boite à outils citoyenne connectée " + liveType;

	setTitle("Communecter" + liveType, "<i class='fa fa-heartbeat '></i>");
	
	//showTagsScopesMin("#list_tags_scopes");
	<?php if(@$lockCityKey){ ?>
		lockScopeOnCityKey("<?php echo $lockCityKey; ?>");
	<?php }else{ ?>
		rebuildSearchScopeInput();
	<?php } ?>
    $("#btn-slidup-scopetags").click(function(){
      slidupScopetagsMin();
    });
	$('#btn-start-search').click(function(e){
		startSearch(false);
    });
		
	
    $('.tooltips').tooltip();
    searchPage = true;
	startSearch(true);

	$(".titleNowEvents .btnhidden").hide();

	//init loading in scroll
    $(window).off().bind("scroll",function(){ 
	    if(!loadingData && !scrollEnd){
	          var heightWindow = $("html").height() - $("body").height();
	          console.log(heightWindow);
	          if( $(this).scrollTop() >= heightWindow - 400){
	            //loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
	            showNewsStream(false);
	          }
	    }
	});

    initKInterface();//{"affixTop":10});
    initFreedomInterface();

    //KScrollTo(".main-btn-scopes");
});

//var freedomCategories = <?php //echo json_encode($freedomSections); ?>

function initFreedomInterface(){
	
	initFormImages();

	//loadLiveNow();
}

var timeout;
function startSearch(isFirst){
	//Modif SBAR
	//$(".my-main-container").off();
	if(liveScopeType == "global"){
		showNewsStream(isFirst);
	}else{
		showNewsStream(isFirst);//loadStream(0,5);
	}
	//loadLiveNow();
}


function loadStream(indexMin, indexMax){ console.log("LOAD STREAM FREEDOM");
	loadingData = true;
	currentIndexMin = indexMin;
	currentIndexMax = indexMax;

	//isLive = isLiveBool==true ? "/isLive/true" : "";
	//var url = "news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>"+isLive+"/date/"+dateLimit+"?isFirst=1&tpl=co2&renderPartial=true";
		
	var url = "news/index/type/city/isLive/true/date/"+dateLimit+"?tpl=co2&renderPartial=true&nbCol=1";
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+'/'+url,
        data: { indexMin: indexMin, 
        		indexMax:indexMax, 
        		renderPartial:true 
        	},
        success:
            function(data) {
                if(data){ //alert(data);
                	$("#news-list").append(data);
                	//bindTags();
					
				}
				loadingData = false;
				$(".stream-processing").hide();
            },
        error:function(xhr, status, error){
            loadingData = false;
            $("#newsstream").html("erreur");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    $("#newsstream").html("not found");
            }
        }
    });
}

function loadLiveNow () { 

    var searchParams = {
      "name":"",
      "tpl":"/pod/nowList",
      "latest" : true,
      "searchType" : ["<?php echo Event::COLLECTION?>","<?php echo Project::COLLECTION?>",
      				  "<?php echo Organization::COLLECTION?>","<?php echo ActionRoom::COLLECTION?>"], 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "indexMin" : 0, 
      "indexMax" : 10 
    };

    
    /*ajaxPost( "#nowList", baseUrl+"/"+moduleId+'/search/globalautocomplete' , searchParams, function() { 
        bindLBHLinks();
        if($('.el-nowList').length==0)
        	$('.titleNowEvents').addClass("hidden");
        else
        	$('.titleNowEvents').removeClass("hidden");
     } , "html" );*/
}

function showNewsStream(isFirst){ mylog.log("showNewsStream freedom");

	scrollEnd = false;

	var isFirstParam = isFirst ? "?isFirst=1&tpl=co2" : "?tpl=co2";
	isFirstParam += "&nbCol=1";
	var tagSearch = $('#searchTags').val().split(',');; //$('#searchBarText').val();
	var levelCommunexionName = { 1 : "CITYKEY",
	                             2 : "CODE_POSTAL",
	                             3 : "DEPARTEMENT",
	                             4 : "REGION"
	                           };
	
	var thisType="ko";
	var urlCtrl = ""
	if(liveScopeType == "global") {
		thisType = "city";
		urlCtrl = "/news/index/type/city/isLive/true";
	}
	/*<?php if(@Yii::app()->session["userId"]){ ?>
	else if(liveScopeType == "community"){
		thisType = "citoyens";
		urlCtrl = "/news/index/type/citoyens/id/<?php echo @Yii::app()->session["userId"]; ?>/isLive/true";
	}
	<?php } ?>*/
	
	var dataNewsSearch = {};
	if(liveScopeType == "global")
		dataNewsSearch = {
	      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
	      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
	      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
	      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),

	    };

    dataNewsSearch.tagSearch = tagSearch;
    dataNewsSearch.searchType = searchType; 
    dataNewsSearch.textSearch = $('#main-search-bar').val();
       
    //dataNewsSearch.type = thisType;
    //var myParent = <?php echo json_encode(@$parent)?>;
    //dataNewsSearch.parent = { }

  var loading = "<div class='loader text-dark '>"+
		"<span style='font-size:25px;' class='homestead'>"+
			"<i class='fa fa-spin fa-circle-o-notch'></i> "+
			"<span class='text-dark'>Chargement en cours ...</span>" + 
	"</div>";

	//loading = "";

	if(isFirst){ //render HTML for 1st load
		$("#newsstream").html(loading);
		ajaxPost("#newsstream",baseUrl+"/"+moduleId+urlCtrl+"/date/0"+isFirstParam,dataNewsSearch, function(news){
			showTagsScopesMin(".list_tags_scopes");
			if(loadContent != ''){
				if(userId){
					showFormBlock(true);
					if(loadContent.indexOf("%hash%"))
						loadContent = loadContent.replace("%hash%", "#");
					$("#get_url").val(loadContent);
					$("#get_url").trigger("input");

				}
				else {
					toastr.error('you must be loggued to post on communecter!');
				}
			}
			else
				showFormBlock(false);

			bindTags();

			$("#formCreateNewsTemp").appendTo("#modal-create-anc #formCreateNews");
			$("#info-write-msg").html("Conseil : donnez un maximum de détails");
			$("#info-write-msg").html("Conseil : donnez un maximum de détails");
			showFormBlock(true);
			//$("#formCreateNewsTemp").html("");

	 	},"html");
	}else{ //data JSON for load next
		dateLimit=0;currentMonth = null;
		$(".newsTL").html(loading);
		$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+urlCtrl+"/date/"+dateLimit+"?tpl=co2",
		       	dataType: "json",
		       	data: dataNewsSearch,
		    	success: function(data){
			    	//mylog.log("LOAD NEWS BY AJAX");
			    	//mylog.log(data.news);
			    	$(".newsTL").html('<div class="spine"></div>');
					if(data){
						buildTimeLine (data.news, 0, 5);
						bindTags();
						if(typeof(data.limitDate.created) == "object")
							dateLimit=data.limitDate.created.sec;
						else
							dateLimit=data.limitDate.created;
					}
					loadingData = false;
				},
				error: function(){
					loadingData = false;
				}
			});
	}
	$("#dropdown_search").hide(300);
	
}

function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
    mylog.log(searchType);
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
  mylog.log(searchType);
}

function hideNewLiveFeedForm(){
	//$("#newLiveFeedForm").hide(200);
	showFormBlock(false);
}

</script>
</script>