<?

/*
	$daumSeq				// (int) 시퀀스.  
	$daumName				// (Sting) submit될 name 
	$daumDefault			// (String) default 값. 
	$areaHeight				// (int) 높이 값. 
*/
?>
<!-- 에디터 컨테이너 시작 -->
	<div id="tx_trex_container<?=$daumSeq?>" class="tx-editor-container" style="padding-right: 15px;max-width:800px;">
		<!-- 사이드바 -->
		<div id="tx_sidebar<?=$daumSeq?>" class="tx-sidebar" style="display:none"></div>
		<div id="tx_toolbar_basic<?=$daumSeq?>" class="tx-toolbar tx-toolbar-basic" style="display:none"></div>
		<!-- 툴바 - 기본 끝 -->
		<!-- 툴바 - 더보기 시작 -->
		<div id="tx_toolbar_advanced<?=$daumSeq?>" class="tx-toolbar tx-toolbar-advanced"><div class="tx-toolbar-boundary">
			
		</div></div>
<!-- 툴바 - 더보기 끝 -->
<!-- 편집영역 시작 -->
	<!-- 에디터 Start -->
	<div id="tx_canvas<?=$daumSeq?>" class="tx-canvas">
		<div id="tx_loading<?=$daumSeq?>" class="tx-loading"><div><img src="/admin/daumeditor/images/icon/editor/loading2.png" width="113" height="21" align="absmiddle"/></div></div>
		<div id="tx_canvas_wysiwyg_holder<?=$daumSeq?>" class="tx-holder" style="display:block;">
			<iframe id="tx_canvas_wysiwyg<?=$daumSeq?>" name="tx_canvas_wysiwyg" allowtransparency="true" frameborder="0"></iframe>
		</div>
		<div class="tx-source-deco">
			<div id="tx_canvas_source_holder<?=$daumSeq?>" class="tx-holder">
				<textarea id="tx_canvas_source<?=$daumSeq?>" rows="30" cols="30"></textarea>
			</div>
		</div>
		<div id="tx_canvas_text_holder<?=$daumSeq?>" class="tx-holder">
			<textarea id="tx_canvas_text<?=$daumSeq?>" rows="30" cols="30"></textarea>
		</div>
	</div>
					<!-- 높이조절 Start -->
	<!--div id="tx_resizer<?=$daumSeq?>" class="tx-resize-bar">
		<div class="tx-resize-bar-bg"></div>
		<img id="tx_resize_holder<?=$daumSeq?>" src="/admin/daumeditor/images/icon/editor/skin/01/btn_drag01.gif" width="58" height="12" unselectable="on" alt="" />
	</div-->
	<!--div class="tx-side-bi" id="tx_side_bi<?=$daumSeq?>">
		<div style="text-align: right;">
			<img hspace="4" height="14" width="78" align="absmiddle" src="/admin/daumeditor/images/icon/editor/editor_bi.png" />
		</div>
	</div-->
	<!-- 편집영역 끝 -->
<!-- 첨부박스 시작 -->
	<!-- 파일첨부박스 Start -->
	<div style="display:none">
	<div id="tx_attach_div<?=$daumSeq?>" class="tx-attach-div">
		<div id="tx_attach_txt<?=$daumSeq?>" class="tx-attach-txt">파일 첨부</div>
		<div id="tx_attach_box<?=$daumSeq?>" class="tx-attach-box">
			<div class="tx-attach-box-inner">
				<div id="tx_attach_preview<?=$daumSeq?>" class="tx-attach-preview"><p></p><img src="/admin/daumeditor/images/icon/editor/pn_preview.gif" w4th="147" height="108" unselectable="on"/></div>
				<div class="tx-attach-main">
					<div id="tx_upload_progress<?=$daumSeq?>" class="tx-upload-progress"><div>0%</div><p>파일을 업로드하는 중입니다.</p></div>
					<ul class="tx-attach-top">
						<li id="tx_attach_delete<?=$daumSeq?>" class="tx-attach-delete"><a>전체삭제</a></li>
						<li id="tx_attach_size<?=$daumSeq?>" class="tx-attach-size">
							파일: <span id="tx_attach_up_size<?=$daumSeq?>" class="tx-attach-size-up"></span>/<span id="tx_attach_max_size<?=$daumSeq?>"></span>
						</li>
						<li id="tx_attach_tools<?=$daumSeq?>" class="tx-attach-tools">
						</li>
					</ul>
					<ul id="tx_attach_list<?=$daumSeq?>" class="tx-attach-list"></ul>
				</div>
			</div>
		</div>
	</div>
	</div>
<!-- 첨부박스 끝 -->
</div>		

<textarea id="daumDefault<?=$daumSeq?>" name="<?=$daumName?>" style="display:none;"><?=$daumDefault?></textarea>
<!-- 에디터 컨테이너 끝 -->
<script>
config[<?=$daumSeq?>] = {
		txHost: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) http://xxx.xxx.com */
		txPath: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) /xxx/xxx/ */
		txService: 'sample', /* 수정필요없음. */
		txProject: 'sample', /* 수정필요없음. 프로젝트가 여러개일 경우만 수정한다. */
		initializedId: "<?=$daumSeq?>", /* 대부분의 경우에 빈문자열 */
		wrapper: "tx_trex_container<?=$daumSeq?>", /* 에디터를 둘러싸고 있는 레이어 이름(에디터 컨테이너) */
		form: 'frm'+"", /* 등록하기 위한 Form 이름 */
		txIconPath: "/admin/daumeditor/images/icon/editor/", /*에디터에 사용되는 이미지 디렉터리, 필요에 따라 수정한다. */
		txDecoPath: "/admin/daumeditor/images/deco/contents/", /*본문에 사용되는 이미지 디렉터리, 서비스에서 사용할 때는 완성된 컨텐츠로 배포되기 위해 절대경로로 수정한다. */
		areaHeight: "<?=$areaHeight?>",
		daumName: "<?=$daumName?>",
		canvas: {
            exitEditor:{
                /*
                desc:'빠져 나오시려면 shift+b를 누르세요.',
                hotKey: {
                    shiftKey:true,
                    keyCode:66
                },
                nextElement: document.getElementsByTagName('button')[0]
                */
            },
			styles: {
				color: "#123456", /* 기본 글자색 */
				fontFamily: "굴림", /* 기본 글자체 */
				fontSize: "10pt", /* 기본 글자크기 */
				backgroundColor: "#fff", /*기본 배경색 */
				lineHeight: "1.5", /*기본 줄간격 */
				padding: "8px" /* 위지윅 영역의 여백 */
			},
			showGuideArea: false,
            autolink: false
		},
		events: {
			preventUnload: false
		},
		sidebar: {
			attachbox: {
				show: true,
				confirmForDeleteAll: true
			}
		},
		size: {
			contentWidth: 700 /* 지정된 본문영역의 넓이가 있을 경우에 설정 */
		},
        toolbar: {
            codehighlight: {
                styleSheetUrl: ["http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css"],
                highlight: function(code){
                    return prettyPrintOne(code);
                }
            },
            paste: {
//                defaultMode: Trex.Paste.MODE_HTML
            }
        }
	};

</script>
