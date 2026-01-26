import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  // ビルド設定
  build: {
    // 出力ディレクトリ
    outDir: 'dist',
    // マニフェストファイルを生成（本番環境でのアセット読み込みに使用）
    manifest: true,
    // エントリーポイント
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/main.js'),
      },
    },
  },

  // 開発サーバー設定
  server: {
    // CORSを許可（WordPressからのアクセスを許可）
    cors: true,
    // ポート番号
    port: 5173,
    // HMR（Hot Module Replacement）設定
    hmr: {
      host: 'localhost',
    },
  },
});
