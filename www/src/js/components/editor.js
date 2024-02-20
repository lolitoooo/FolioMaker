import grapesjs from 'grapesjs';
import blocks from 'grapesjs-blocks-basic';

const editor = grapesjs.init({
  container : '#gjs',
  // ...
  plugins: [blocks],
  pluginsOpts: {
    blocks: {}
  },
});