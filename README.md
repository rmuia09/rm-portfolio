# RM Portfolio — WordPress block theme

This is your site redesigned as a custom WordPress theme: same editorial look
(big display type, micro-labels, numbered work lists, scroll reveals), but every
page and post is editable from the WordPress dashboard.

## What's inside

```
rm-portfolio/
├── style.css            Theme header + all styling
├── theme.json           Palette, fonts, editor settings
├── functions.php        Loads fonts + reveal script
├── assets/
│   ├── rm.js            Scroll-reveal animations
│   └── editor.css       Makes the block editor preview match the site
├── templates/
│   ├── front-page.html  The editorial homepage (hero, work list, proof, writing, contact)
│   ├── page.html        For regular pages (case studies, about, contact)
│   ├── single.html      For blog posts (adds the date label)
│   └── index.html       Blog archive (lists your posts automatically)
├── parts/
│   ├── header.html      Sticky nav (auto-lists your pages)
│   └── footer.html      "(© 2026 Richard Muia)"
└── patterns/
    └── outcome.php      Reusable "Outcome box" block pattern for case studies
```

## Install (5 minutes)

1. **Back up first:** WP Admin → Tools → Export → Download Export File. Also screenshot
   your current homepage for reference.
2. Zip the `rm-portfolio` folder (it's already zipped next to this folder:
   `rm-portfolio.zip`).
3. WP Admin → Appearance → Themes → **Add New Theme** → **Upload Theme** →
   choose `rm-portfolio.zip` → Install → **Activate**.
4. Visit your site — the homepage design is live. The nav auto-lists pages as you
   create them (Appearance → Menus, or it defaults to all published pages).

## Automated content import (10 minutes) — do this instead of Phases 1–5

There is an automated tool: WordPress's own **importer**, fed a ready-made import file
(`rm-content-export.xml`, sitting next to this README). It creates all pages and posts
fully formed — correct titles, slugs, nesting, and formatting — in one upload.

> [!NOTE]
> Do this **after** installing and activating the theme (Install section above),
> and **before** Phase 6 (CV PDFs).

1. WP Admin → **Tools → Import** → click **WordPress** ("Install Now", then "Run
   Importer" — this installs the official WordPress Importer plugin).
2. Upload `rm-content-export.xml` from this folder.
3. Author mapping: map "admin" → **your admin user**.
4. Leave **"Download and import file attachments"** unticked (there are none).
5. Submit. You should end with **10 items imported**.

What it creates:

| Type | Items |
|---|---|
| Pages | Work (parent) · Cellulant, AZA, Tracom case studies (nested under Work) · About · Contact |
| Posts | Defect leakage is a retention metric · Reproducing the unreproducible · Scaling support without scaling headcount · What I learned from reading PostHog's website source code |

Then do Phase 0 (permalinks → "Post name") if you haven't already — the homepage
links in the freshly uploaded theme already point to the imported URLs
(`/work/cellulant/`, `/defect-leakage-retention/`, …), so **Phase 5 is unnecessary**.

Still manual afterwards (they can't be in an import file):
- **Phase 6:** CV PDFs (export → Media Library → link the buttons).
- **Two `[EDIT]` placeholders** on the About page (edit in Pages → About):
  your CV links, and one genuine "Beyond work" line.

### If the import goes wrong

- Partial import: just delete the imported pages/posts (they're all named exactly as
  in the table above) and re-run — the import uses fixed IDs, so re-importing on an
  empty state is clean.
- "Invalid file" error: make sure you didn't open-and-resave the XML in a text editor
  that mangled encoding; re-copy the original file instead.

---

## Recreate your content as WordPress content (one evening) — FALLBACK

The theme is empty of content by design — WordPress sites manage content, not files.
All copy to paste lives in the static-site backup: `Documents/portfolio-static-site`.
Open the HTML files in a **browser** and copy the visible text (easier than stripping
tags from source).

**You can skip this entire section if the automated import above succeeded.**

### Phase 0 — One-time setup (5 min)

1. **Settings → Permalinks** → select **"Post name"** → Save.
   (Makes URLs like `/work/cellulant/` work — the theme's homepage links expect it.)

### Phase 1 — The three case-study pages

Do Cellulant fully first; AZA and Tracom are pure repetition.

1. Get the source text: open `portfolio-static-site/work/cellulant.html` in your browser.
2. **Pages → Add New**.
3. Title: `Turning customer reports into permanent fixes`.
4. Slug (right sidebar → Page → URL): `cellulant` — nesting under a Work parent comes in Phase 5.
5. Paste the sections as blocks:
   - Section titles → **Heading** blocks ("The customer problem", "What I investigated",
     "What I built and shipped", "What I'd tell a customer success team").
   - Body text → **Paragraph** blocks; bullets → **List** block.
   - Intro meta line at the very top as one Paragraph:
     "Cellulant Kenya Limited · Senior QA Engineer in Test · Jan 2025 – present".
6. Outcome box: `+` → **Patterns** tab → **Featured** → **RM: Outcome Box** → insert,
   then replace the placeholder with the real outcome sentence from the browser version.
7. **Publish.**
8. Repeat for AZA (slug `aza`) and Tracom (slug `tracom`) from `work/aza.html` / `work/tracom.html`.

### Phase 2 — About page

1. **Pages → Add New** → title `About` → slug `about`.
2. Paste from `portfolio-static-site/about/index.html`: career-story paragraphs,
   "What I work with" as a List block.
3. "Beyond work" line: write your own genuine version — don't copy the placeholder.
4. Skip CV buttons for now (Phase 6). Publish.

### Phase 3 — Contact page

1. **Pages → Add New** → title `Contact` → slug `contact`.
2. Intro paragraph + email, LinkedIn, GitHub — a **Social Icons** block looks best,
   or three lines of linked text. Publish.

### Phase 4 — The four blog posts

For each (fastest done last):

1. **Posts → Add New** → title = post title.
2. Paste content from the matching file in `portfolio-static-site/writing/`:
   headings → Heading blocks, rest → Paragraph/List blocks.
3. Skip the bold meta line at the top — the theme shows the post date automatically.
4. Publish. Repeat for all four:
   - "Defect leakage is a retention metric" ← `writing/defect-leakage-retention.html`
   - "Reproducing the unreproducible" ← `writing/reproducing-unreproducible.html`
   - "Scaling support without scaling headcount" ← `writing/scaling-support-without-headcount.html`
   - "What I learned from reading PostHog's website source code" ← `writing/what-posthog-website-taught-me.html`

### Phase 5 — Make the homepage links work

The homepage's work list points to `/work/cellulant/` etc., but your pages are at
`/cellulant/` so far. Fix the work links by nesting:

1. **Pages → Add New** → title `Work` → slug `work` → publish (one intro line, no more).
2. **Pages → Quick Edit** → Cellulant → Parent Page: **Work** → Update.
   Same for AZA and Tracom.
3. Verify: Cellulant's URL is now `nrichardmuia.com/work/cellulant/` — matching the theme.

The writing list points to `/writing/…` but posts can't have parents — so fix those
links directly:

- **Appearance → Editor → Templates → Front Page** → click each writing list item →
  update the URL to remove the `/writing/` prefix (e.g. `/defect-leakage-retention/`).

(Alternative: leave slugs as they are and edit every list link — more fiddly.)

### Phase 6 — CV PDFs

1. Export both CVs to PDF: `richard_muia_technical_csm_cv.md` → `richard-muia-csm.pdf`,
   QA-positioned CV → `richard-muia-qa.pdf`.
2. **Media → Add New** → upload both → click each → **Copy URL**.
3. About page: link each button to its Media URL.
4. **Appearance → Editor → Templates → Front Page** → update the "Download CV" button link.

### Phase 7 — Final check (15 min)

- [ ] Every homepage list link lands on a real page
- [ ] Phone check: nav, lists, hero all readable
- [ ] pagespeed.web.dev → aim 85+ mobile (install **LiteSpeed Cache** plugin if lower)
- [ ] CV buttons download the PDFs
- [ ] Update the portfolio link on your CV and LinkedIn to `nrichardmuia.com`

## Upkeep (the honest cost of WordPress)

- Update WordPress + this theme when prompted (the theme is yours; updates won't erase it,
  but keep this folder as your backup of it).
- Speed: install one caching plugin (LiteSpeed Cache — your host is LiteSpeed) and you're set.
- If you ever leave WordPress, the static design lives on in
  `Documents/portfolio-static-site`.

## Upload checklist

- [ ] WP export downloaded (backup)
- [ ] Theme zip uploaded + activated
- [ ] `rm-content-export.xml` imported via Tools → Import → WordPress (10 items)
- [ ] Permalinks set to "Post name" (Phase 0)
- [ ] Homepage list links verified (work + writing land on imported pages/posts)
- [ ] CV PDFs uploaded to Media Library; About/hero buttons linked (Phase 6)
- [ ] About page: two `[EDIT]` placeholders filled in
- [ ] Old WordPress theme deactivated (keep one default theme installed)
- [ ] Sample Page / sample post / placeholder content deleted
