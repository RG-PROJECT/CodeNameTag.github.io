<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> MakeNameTag</title>
      <!-- Bootstrap -->
      <!-- <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->

      <!-- CDN -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="./css/style.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    </head>

    <body>
      <header>
        <nav class="top-header">
          <div class="row">
            <div class="col-md-2">
                <h2 class="logo">
                  <a href="#">Logo</a>
                </h2>
            </div>
            <div class="col-md-10">
              <h2> This is a header place</h2>
            </div>
          </div>
        </nav>
        <hr>
      </header>

      <div calss = "container">
        <div class="row">
          <div class="col-md-4">
            <div class="custom-area text-center" >
                <h1>Input Area</h1>
                <ul class="input">
                  <form id="userInput" class="" action="index.html" method="post">
                    <div class="form-group">
                      <label for="inputName">이름</label>
                      <input type="text" class="form-control" id="InputName" placeholder ="name">
                    </div>
                    <div class="form-group">
                      <label for="inputCorp">회사</label>
                      <input type="text" class="form-control" id="InputCorp" placeholder ="corp">
                    </div>
                    <div class="form-group">
                      <label for="inputPosition">직책</label>
                      <input type="text" class="form-control" id="InputPosition" placeholder ="position">
                    </div>
                  </form>
                  <div class="language">
                    <label for="selLanguage">언어</label>
                    <select class="form-control" id="selLanguage">
                      <option>Language</option>
                      <option value="c">C</option>
                      <option value="cpp">C++</option>
                      <option value="java">JAVA</option>
                      <option value="javascript">Javascript</option>
                      <option value="python">Python</option>
                      <option value="swift">Swift</option>
                    </select>
                  </div>
                  <div class="theme">
                    <label for="selTheme">테마</label>
                    <select class="form-control" id="selTheme">
                      <option>Theme</option>
                      <option value="default">default</option>
                      <option value="sunset">sunset</option>
                      <option value="">dark</option>
                      <option value="">eclipse</option>
                    </select>
                  </div>
                  <input class="btn btn-info" type="submit" value="Share">
                  <input class="btn btn-success" type="submit" value="Generation">
                </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="preveiw-area text-center">
                <h1>Preview Area</h1>
                <div class="nameTag">
					<div class="preview" id="cardPreview">
						<span class="varName"><span class="varType"></span> name <span class="symbol">=</span> </span>
						<span class="name">"name"</span><span class="semicolon symbol"></span>
						<span class="comment"><span class="cstart"></span><span class="position">position</span><span class="cend"></span></span>
						<span class="company">company</span>
					</div>

                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="user-guide text-center">
                <h1>User Guide</h1>
            </div>
          </div>
          </div>
        </div>
      </div>



      <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script>
      	var cardLangTemplate = {
			swift : { varType: 'let ', semicolon : false, commentStart: '/*', commentEnd: '*/'},
			c     : { varType: 'char[] ', semicolon: true, commentStart: '/*', commentEnd: '*/' },
			cpp   : { varType: 'std::string', semicolon: true, commentStart: '/*', commentEnd: '*/' },
			python: { varType: '', semicolon: false, commentStart: '\'\'\'', commentEnd: '\'\'\'' },
			javascript: { varType: 'var', semicolon: true, commentStart: '/*', commentEnd: '*/' },
			java  : { varType: 'String', semicolon: true, commentStart: '/*', commentEnd: '*/' }
		};
		var cardColorTemplate = {
			default : { varType :'#3a95ae', varName : '#000', str : '#b22821', comment : '#008d14' },
			sunset : { varType :'#007020', varName : '#bb60d5', str : '#4070a0', comment : '#60a0b0' }
		};

      	$(document).ready(function() {
      		// 이름 변경 적용
      		$('#InputName').on("change paste keyup", function() {
   				//console.log($(this).val());
   				$('#cardPreview .name').text('"' + $(this).val() + '"');
			});

      		// 직급
			$('#InputPosition').on("change paste keyup", function() {
   				//console.log($(this).val());
   				$('#cardPreview .position').text($(this).val());
			});

			// 회사
			$('#InputCorp').on("change paste keyup", function() {
   				//console.log($(this).val());
   				$('#cardPreview .company').text($(this).val());
			});

			$('#selLanguage').change(function() {
				var lang = $(this).val();
				if (typeof cardLangTemplate[lang] == "object") {
					$('#cardPreview .varType').text(cardLangTemplate[lang].varType);
					if (cardLangTemplate[lang].semicolon) {
						$('#cardPreview .semicolon').text(";");
					}else {
						$('#cardPreview .semicolon').text("");
					}
					$('#cardPreview .comment .cstart').text(cardLangTemplate[lang].commentStart + ' ');
					if (cardLangTemplate[lang].commentEnd.length > 0) {
						$('#cardPreview .comment .cend').text(' ' + cardLangTemplate[lang].commentEnd);
					}else {
						$('#cardPreview .comment .cend').text('');
					}
				}
			});
			$('#selTheme').change(function() {
				newTemplate = $(this).val();
				if (typeof cardColorTemplate[newTemplate] == "object") {
					$('#cardPreview .varType').css('color', cardColorTemplate[newTemplate].varType);
					$('#cardPreview .varName').css('color', cardColorTemplate[newTemplate].varName);
					$('#cardPreview .name').css('color', cardColorTemplate[newTemplate].str);
					$('#cardPreview .comment').css('color', cardColorTemplate[newTemplate].comment);
				}else {
					console.log('잘못된 테마 이름 : ' + $(this).val());
				}
			});

      	});
      </script>
    </body>

</html>
