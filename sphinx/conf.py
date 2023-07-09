## import os
## import sys
## sys.path.insert(0, os.path.abspath("_themes"))
# Configuration file for the Sphinx documentation builder.
#
# For the full list of built-in configuration values, see the documentation:
# https://www.sphinx-doc.org/en/master/usage/configuration.html

# -- Project information -----------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#project-information

project = 'Open FDA API'
copyright = "MIT License"
author = 'Kurt Krueckeberg'
release = '0.7'

# -- General configuration ---------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#general-configuration

extensions = ['myst_parser']

myst_enable_extensions = [
  "colon_fence", "deflist"
]

templates_path = ['_templates']
exclude_patterns = ['_build', 'Thumbs.db', '.DS_Store', 'readme.md']

source_suffix = {
    '.rst': 'restructuredtext',
    '.md': 'markdown',
}

# -- Options for HTML output -------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#options-for-html-output

#html_theme = 'piccolo_theme'
html_theme = 'sphinx_book_theme'

html_static_path = ['_static']

html_css_files = [
   'custom.css',
]
