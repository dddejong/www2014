The Random Images module allows you to create blocks containing random images 
uploaded into selected node.

Notes:
1. This module does not resize images.
2. If caching is enabled, the random images will only cycle when the cache is cleared.

Instructions:
1. Copy the module folder to /sites/all/modules or /sites/default/modules
2. Enable "Random Images" and "Upload" at admin/build/modules
3. For comfortable images management recommended to install "Upload Preview" module
4. Create page or story and upload images. Fill Description fields for uploaded files
5. Specify a location of the first random image block at admin/build/block
6. Specify a block settings at admin/build/block/configure/random_images/1
   Specify the human-readable block name
   Specify node number (node with uploaded images)
7. If you want more blocks you can change "blocks count" value
8. Specify the permissions at admin/user/permissions#module-random_images
9. Uploaded images you also can see at random_images/1
