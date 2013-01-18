/*!
 * Ext JS Library 3.2.0
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
Ext.onReady(function(){

    // create the Data Store
    var store = new Ext.data.Store({
        // load using HTTP
        url: 'test2.xml',

        // the return will be XML, so lets set up a reader
        reader: new Ext.data.XmlReader({
               // records will have a "video" tag
               record: 'video',
               id: 'id',
               totalRecords: '@total'
           }, [
               // set up the fields mapping into the xml doc
               // The first needs mapping, the others are very basic
               'id','title', 'videoDirectory', 'caption','filename','channel'
           ])
    });

    // create the grid
    var grid = new Ext.grid.GridPanel({
        store: store,
        columns: [
            {header: "ID", width: 120, dataIndex: 'id', sortable: true},
            {header: "Title", width: 180, dataIndex: 'title', sortable: true},
            {header: "Directory", width: 115, dataIndex: 'videoDirectory', sortable: true},
            {header: "Caption", width: 100, dataIndex: 'caption', sortable: true},
            {header: "Filename", width: 100, dataIndex: 'filename', sortable: true},
            {header: "Channel", width: 100, dataIndex: 'channel', sortable: true}
        ],
        renderTo:'example-grid',
        width:800,
        height:400
    });

    store.load();
});
