const {defineConfig} = require('@vue/cli-service')
const webpack        = require('webpack');

module.exports = defineConfig({
                                  // pages: {
                                  //     index: {
                                  //         // entry for the page
                                  //         entry: 'src/main.js',
                                  //         title: 'EZY',
                                  //     },
                                  // },

                                  devServer: {
                                      client: {
                                          overlay: false
                                      }
                                  },

                                  transpileDependencies: true,
                                  chainWebpack         : config => {
                                      config.module
                                            .rule('vue')
                                            .use('vue-loader')
                                            .tap(options => {
                                                options.compilerOptions = {
                                                    ...options.compilerOptions,
                                                    isCustomElement: tag => tag.startsWith('ion-')
                                                }
                                                return options
                                            })
                                  },

                                  configureWebpack: {
                                      plugins: [
                                          new webpack.DefinePlugin({
                                                                       // Vue CLI is in maintenance mode, and probably won't merge my PR to fix this in their tooling
                                                                       // https://github.com/vuejs/vue-cli/pull/7443
                                                                       __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false',
                                                                   })
                                      ],
                                  }
                              })
