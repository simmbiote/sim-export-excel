<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p><?php  _e('This page allows you to export certain types of supported content to Excel. <br /> Simply press <strong>Export to Excel</strong> for the relevant supported content type.
        Shortly thereafter you will be prompted to download a .xlsx file.', 'sim-export'); ?></p>

    <table class="widefat">
        <thead>
        <tr>
            <th><strong><?php _e('Content Type', 'sim-export'); ?></strong></th>
            <th><strong><?php _e('Export', 'sim-export'); ?></strong></th>
        </tr>
        </thead>
        <tr>
            <td><strong>Flamingo Inbound Messages</strong></td>
            <td>
                <a href="?sim_export=flamingo_inbound" class="button button-primary export">Export to Excel</a>
            </td>
        </tr>
    </table>
</div>

