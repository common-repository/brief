  window.addEventListener('DOMContentLoaded', (event) => {

    /**
     * Convert Markdown Text
     */
    const briefLog = document.querySelector('#briefChangelog')
    const briefDocs = document.querySelector('#briefDocs')

    if (briefLog && briefDocs) {
      const briefLogText = briefLog.querySelector('.brief-tabs-card__content')
      const briefDocsText = briefDocs.querySelector('.brief-tabs-card__content')

      const converter = new showdown.Converter()

      let text = briefLogText.innerHTML
      let html = converter.makeHtml(text)
      briefLogText.innerHTML = html

      text = briefDocsText.innerHTML
      html = converter.makeHtml(text)
      briefDocsText.innerHTML = html
    }

    /**
     * Tabs
     */
    const wbpTabs = document.querySelectorAll('.brief-tabs-links')
    if (wbpTabs) {
      wbpTabs.forEach((el) => {
        el.addEventListener('click', (e) => {
          e.preventDefault()
          const target = e.currentTarget

          // Active Tabs
          wbpTabs.forEach((el) => {
            el.classList.remove('active')
          })

          target.classList.add('active')

          const hash = target.hash
          const tab = document.querySelector(hash)

          if (tab) {
            const tabs = document.querySelectorAll('.brief-tabs-card')
            tabs.forEach((el) => {
              el.classList.remove('active')
            })

            tab.classList.add('active')
          }
        })
      })
    }

    /**
     * Expand
     */
    const briefExpand = document.querySelector('.brief-expand')
    if (briefExpand) {
      briefExpand.addEventListener('click', (e) => {
        e.preventDefault()
        e.currentTarget.classList.add('hide')

        const briefTabsContent = document.querySelectorAll(
          '.brief-tabs-card__content'
        )

        if (briefTabsContent) {
          briefTabsContent.forEach((el) => {
            el.classList.add('expand')
          })
        }
      })
    }
  })

  /**
   * Upload Brand
   */
  jQuery(document).ready(function ($) {
    if (wp.media) {
      // Uploading files
      var file_frame
      var wp_media_post_id = wp.media.model.settings.post.id // Store the old id
      var set_to_post_id = $('#brief_settings[brand]').val()

      jQuery('#briefBtnUpload').on('click', function (event) {
        event.preventDefault()

        // If the media frame already exists, reopen it.
        if (file_frame) {
          // Set the post ID to what we want
          file_frame.uploader.uploader.param('post_id', set_to_post_id)
          // Open frame
          file_frame.open()
          return
        } else {
          // Set the wp.media post id so the uploader grabs the ID we want when initialised
          if (set_to_post_id) {
            wp.media.model.settings.post.id = set_to_post_id
          }
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
          title: 'Select a image to upload',
          button: {
            text: 'Use this image',
          },
          multiple: false, // Set to true to allow multiple files to be selected
        })

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
          // We set multiple to false so only get one image from the uploader
          attachment = file_frame.state().get('selection').first().toJSON()
          // Do something with attachment.id and/or attachment.url here
          $('#briefImgPreview').attr('src', attachment.url)
          $('#brief_settings\\[brand\\]').val(attachment.id)
          $('#briefBtnRemove').addClass('active')
          $('.brief-img-wrapper').addClass('active')

          // Restore the main post ID
          wp.media.model.settings.post.id = wp_media_post_id
        })

        // Finally, open the modal
        file_frame.open()
      })

      jQuery('#briefBtnRemove').on('click', function (event) {
        $('#brief_settings\\[brand\\]').val('')
        $('#briefImgPreview').attr('src', '')
        $('#briefBtnRemove').removeClass('active')
        $('.brief-img-wrapper').removeClass('active')
      })

      // Restore the main ID when the add media button is pressed
      jQuery('a.add_media').on('click', function () {
        wp.media.model.settings.post.id = wp_media_post_id
      })
    }
  })

