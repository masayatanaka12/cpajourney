# CPA Journey WordPress Theme

Viteを使用したWordPressテーマの開発環境です。

## セットアップ

```bash
# 依存関係のインストール
npm install
```

## 開発

### 開発サーバーの起動

```bash
npm run dev
```

これにより、Vite開発サーバーが `http://localhost:5173` で起動します。

### 開発モードの有効化

開発中にHMR（Hot Module Replacement）を有効にするには、`hot` ファイルを作成します：

```bash
touch hot
```

また、`wp-config.php` で `WP_DEBUG` が `true` に設定されていることを確認してください：

```php
define('WP_DEBUG', true);
```

### 本番ビルド

```bash
npm run build
```

ビルドされたファイルは `dist/` ディレクトリに出力されます。

本番環境では `hot` ファイルを削除してください：

```bash
rm hot
```

## ファイル構造

```
cpajpurney/
├── dist/               # ビルド出力（gitignore）
├── node_modules/       # npm依存関係（gitignore）
├── src/
│   ├── main.js         # JSエントリーポイント
│   └── styles/
│       └── style.scss  # メインスタイル
├── .gitignore
├── footer.php          # フッターテンプレート
├── functions.php       # テーマ機能
├── header.php          # ヘッダーテンプレート
├── index.php           # メインテンプレート
├── package.json        # npm設定
├── style.css           # WordPressテーマ情報
├── vite.config.js      # Vite設定
└── README.md
```

## 使い方

1. `npm install` で依存関係をインストール
2. `npm run dev` で開発サーバーを起動
3. `touch hot` でホットリロードを有効化
4. WordPressの管理画面でこのテーマを有効化
5. 開発が完了したら `npm run build` でビルド
6. `rm hot` でホットリロードを無効化
