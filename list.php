<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JSON Reader</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      font-size: 24px;
    }
    select, button {
      margin: 10px 0;
    }
    pre {
      background-color: #f4f4f4;
      padding: 10px;
      border: 1px solid #ddd;
      white-space: pre-wrap;
      word-wrap: break-word;
    }
  </style>
</head>
<body>
  <h1>Select a JSON file (A.json - Z.json)</h1>

  <!-- A～ZまでのJSONファイルを選択するセレクタ -->
  <select id="jsonSelector">
    <!-- オプションを動的に生成 -->
    <script>
      // A〜Zまでの選択肢を自動的に生成
      for (let i = 65; i <= 90; i++) {
        const option = document.createElement('option');
        option.value = String.fromCharCode(i) + '.json';
        option.textContent = String.fromCharCode(i) + '.json';
        document.getElementById('jsonSelector').appendChild(option);
      }
    </script>
  </select>

  <!-- JSONファイルを読み込むボタン -->
  <button onclick="loadJson()">Load JSON</button>

  <!-- 読み込んだJSONデータを表示するエリア -->
  <h2>JSON Data:</h2>
  <pre id="jsonOutput"></pre>

  <script>
    // JSONファイルを読み込む関数
    function loadJson() {
      // セレクターから選ばれたJSONファイルの名前を取得
      const selectedFile = document.getElementById('jsonSelector').value;

      // Fetch APIを使って選択されたJSONファイルを読み込む
      fetch(selectedFile)
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          // JSONデータを画面に表示する
          document.getElementById('jsonOutput').textContent = JSON.stringify(data, null, 2);
        })
        .catch(error => {
          // エラーハンドリング
          document.getElementById('jsonOutput').textContent = `Error: ${error.message}`;
        });
    }
  </script>

  <?php
  // PHPでJSONファイルを読み込む関数
  function loadJsonFile($filename) {
    if (file_exists($filename)) {
      $json = file_get_contents($filename);
      return json_decode($json, true);
    } else {
      return null;
    }
  }

  // JSONファイルを選択した場合、データを取得
  if (isset($_GET['jsonFile'])) {
    $file = basename($_GET['jsonFile']); // セキュリティのためファイル名をサニタイズ
    $data = loadJsonFile($file);
    if ($data) {
      echo '<script>document.getElementById("jsonOutput").textContent = ' . json_encode($data, JSON_PRETTY_PRINT) . ';</script>';
    } else {
      echo '<script>document.getElementById("jsonOutput").textContent = "Error: File not found or invalid JSON";</script>';
    }
  }
  ?>
</body>
</html>