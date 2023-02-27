<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>주소 검색</title>
<?php
//2017년 2월 제공항목이 확대되었습니다. 원하시는 항목을 추가하여 사용하시면 됩니다.
$ADDR['inputYn'] = $_POST['inputYn'];
$ADDR['roadFullAddr'] = $_POST['roadFullAddr'];
$ADDR['roadAddrPart1'] = $_POST['roadAddrPart1'];
$ADDR['roadAddrPart2'] = $_POST['roadAddrPart2'];
$ADDR['engAddr'] = $_POST['engAddr'];
$ADDR['jibunAddr'] = $_POST['jibunAddr'];
$ADDR['zipNo'] = $_POST['zipNo'];
$ADDR['addrDetail'] = $_POST['addrDetail'];
$ADDR['admCd'] = $_POST['admCd'];
$ADDR['rnMgtSn'] = $_POST['rnMgtSn'];
$ADDR['bdMgtSn'] = $_POST['bdMgtSn'];
$ADDR['detBdNmList'] = $_POST['detBdNmList'];
//** 2017년 2월 제공항목 추가 **/
$ADDR['bdNm'] = $_POST['bdNm'];
$ADDR['bdKdcd'] = $_POST['bdKdcd'];
$ADDR['siNm'] = $_POST['siNm'];
$ADDR['sggNm'] = $_POST['sggNm'];
$ADDR['emdNm'] = $_POST['emdNm'];
$ADDR['liNm'] = $_POST['liNm'];
$ADDR['rn'] = $_POST['rn'];
$ADDR['udrtYn'] = $_POST['udrtYn'];
$ADDR['buldMnnm'] = $_POST['buldMnnm'];
$ADDR['buldSlno'] = $_POST['buldSlno'];
$ADDR['mtYn'] = $_POST['mtYn'];
$ADDR['lnbrMnnm'] = $_POST['lnbrMnnm'];
$ADDR['lnbrSlno'] = $_POST['lnbrSlno'];
$ADDR['emdNo'] = $_POST['emdNo'];
?>
</head>

<script language="javascript">
// opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다.
// ("주소입력화면 소스"도 동일하게 적용시켜야 합니다.)
//document.domain = "abc.go.kr";
function init(){
var url = location.href;
var confmKey = ＂U01TX0FVVEgyMDE3MTExMDE3MDA0MjEwNzQ3NDc=＂; // 연계 싞청 시 부여받은 승인키 입력(테스트용 승인키 : TESTJUSOGOKR)
var resultType = “4＂; // 도로명주소 검색결과 화면 출력유형,
// 1 : 도로명, 2 : 도로명+지번, 3 : 도로명+상세건물명, 4 : 도로명+지번+상세건물명
var inputYn= "<?php=$ADDR['inputYn']?>";
if(inputYn != "Y"){
document.form.confmKey.value = confmKey;
document.form.returnUrl.value = url;
document.form.resultType.value = resultType;
document.form.action="http://www.juso.go.kr/addrlink/addrLinkUrl.do"; //인터넷망(행정망의 경우 별도 문의)
//** 2017년 5월 모바일용 팝업 API 기능 추가제공 **/
//document.form.action="http://www.juso.go.kr/addrlink/addrMobileLinkUrl.do"; //모바일 웹인 경우, 인터넷망
document.form.submit();
}else{
opener.jusoCallBack("<?php=$ADDR[roadFullAddr]?>","<?php=$ADDR[roadAddrPart1]?>","<?php=$ADDR[addrDetail]?>", "<?php=$ADDR[roadAddrPart2]?>","<?php=$ADDR[engAddr]?>","<?php=$ADDR[jibunAddr]?>","<?php=$ADDR[zipNo]?>", "<?php=$ADDR[admCd]?>","<?php=$ADDR[rnMgtSn]?>", "<?php=$ADDR[bdMgtSn]?>", "<?php=$ADDR[detBdNmList]?>", "<?php=$ADDR[bdNm]?>", "<?php=$ADDR[bdKdcd]?>", "<?php=$ADDR[siNm]?>", "<?php=$ADDR[sggNm]?>", "<?php=$ADDR[emdNm]?>", "<?php=$ADDR[liNm]?>", "<?php=$ADDR[rn]?>", "<?php=$ADDR[udrtYn]?>", "<?php=$ADDR[buldMnnm]?>", "<?php=$ADDR[buldSlno]?>", "<?php=$ADDR[mtYn]?>", "<?php=$ADDR[lnbrMnnm]?>", "<?php=$ADDR[lnbrSlno]?>", "<?php=$ADDR[emdNo]?>");
window.close();
}
}
</script>
<body onload="init();">
<form id="form" name="form" method="post">
<input type="hidden" id="confmKey" name="confmKey" value=""/>
<input type="hidden" id="returnUrl" name="returnUrl" value=""/>
<input type="hidden" id=“resultType" name=" resultType " value=""/>
<!– 해당 시스템의 인코딩 타입이 EUC-KR일 경우에만 추가 START-->
<!--input type="hidden" id="encodingType" name="encodingType" value="EUC-KR"/-->
<!– 해당 시스템의 인코딩 타입이 EUC-KR일 경우에만 추가 END-->
</form> </body>
</html>