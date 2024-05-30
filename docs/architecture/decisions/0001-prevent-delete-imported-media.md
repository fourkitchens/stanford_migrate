# 1. Site editors shouldn't remove imported photos.
Date: 2024-05-30

## Status

Proposed

## Context

Based on ticket [SHS-5641](https://fourkitchens.clickup.com/t/36718269/SHS-5641), it was requested that non-admins should not be able to remove media items when attached to nodes that have been imported from a migration.

## Decision

After researching different methods to do this programmatically via PHP only, it was decided to perform the back-end checks via PHP and then if a media entity was attached to a node that was migrated, to then set a CSS class to hide the remove button from display. There are other ways of performing these changes, but due to time constrains, it was decided that this made the most sense for now.

An additional feature for the future would be to provide a setting for this in the UI to enable/disable this ability per site.

For this work, the following content types and fields are affected:

```
'hs_person' => [
  'field_hs_person_square_img',
  'field_hs_person_image',
],
'hs_event' => [
  'field_hs_event_image',
],
'hs_news' => [
  'field_hs_news_image',
],
'hs_publications' => [
  'field_hs_publication_image',
],
```

An additional field `su_gallery_images` was found on the Paragraph type "Stanford gallery" and part of the `hs_d7_gallery_paragraphs` migration, but was not included in this work.

## Consequences

As a site editor (or lower role), the ability to remove imported media images has been removed.
