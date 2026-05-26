const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: {
    frontend: "./assets/src/index.js",
    // admin: './assets/src/admin/index.js',
    // editor: './assets/src/editor/index.js',
  },

  output: {
    path: path.resolve(__dirname, "assets/public"),
    filename: "[name].js",
    clean: true,
  },

  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "../", // important for WP paths
            },
          },
          "css-loader",
          "postcss-loader",
          "sass-loader",
        ],
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: { loader: "babel-loader" },
      },
    ],
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
    }),
  ],

  devtool: "source-map",
};
