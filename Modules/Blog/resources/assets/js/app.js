        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle?.querySelector('i');

        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            themeIcon?.classList.remove('fa-moon');
            themeIcon?.classList.add('fa-sun');
        }

        themeToggle?.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                themeIcon?.classList.remove('fa-moon');
                themeIcon?.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon?.classList.remove('fa-sun');
                themeIcon?.classList.add('fa-moon');
            }
        });

        // Mobile Navigation
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');

            if (navMenu.classList.contains('active')) {
                hamburger.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                hamburger.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                hamburger.innerHTML = '<i class="fas fa-bars"></i>';
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Scroll to top button
        // const scrollTopButton = document.getElementById('scrollTop');

        // window.addEventListener('scroll', () => {
        //     if (window.pageYOffset > 300) {
        //         scrollTopButton.classList.add('active');
        //     } else {
        //         scrollTopButton.classList.remove('active');
        //     }
        // });

        // scrollTopButton.addEventListener('click', () => {
        //     window.scrollTo({
        //         top: 0,
        //         behavior: 'smooth'
        //     });
        // });

        // Add animation to elements on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.post-card, .sidebar-widget');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;

                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Initialize animation
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        const showInlineStatus = (element, message, type = 'success') => {
            if (!element) return;

            element.textContent = message;
            element.classList.remove('success', 'error', 'is-visible');
            element.classList.add(type, 'is-visible');
        };

        const parseJsonResponse = async response => {
            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                const firstError = data.errors ? Object.values(data.errors).flat()[0] : null;
                throw new Error(firstError || data.message || 'Something went wrong. Please try again.');
            }

            return data;
        };

        document.querySelectorAll('[data-newsletter-form]').forEach(form => {
            const button = form.querySelector('button[type="submit"]');
            const label = form.querySelector('[data-newsletter-label]');
            const spinner = form.querySelector('[data-newsletter-spinner]');
            const status = form.closest('.sidebar-widget, .footer-widget, .contact-form-container, body')?.querySelector('[data-newsletter-status]');

            form.addEventListener('submit', async event => {
                event.preventDefault();

                button.disabled = true;
                if (label) label.textContent = 'Subscribing';
                if (spinner) spinner.hidden = false;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: new FormData(form),
                    });
                    const data = await parseJsonResponse(response);
                    form.reset();
                    showInlineStatus(status, data.message || 'Thanks for subscribing.', 'success');
                } catch (error) {
                    showInlineStatus(status, error.message, 'error');
                } finally {
                    button.disabled = false;
                    if (label) label.textContent = 'Subscribe';
                    if (spinner) spinner.hidden = true;
                }
            });
        });

        const commentForm = document.querySelector('[data-comment-form]');

        if (commentForm) {
            const button = commentForm.querySelector('button[type="submit"]');
            const label = commentForm.querySelector('[data-comment-label]');
            const spinner = commentForm.querySelector('[data-comment-spinner]');
            const status = document.querySelector('[data-comment-status]');

            commentForm.addEventListener('submit', async event => {
                event.preventDefault();

                button.disabled = true;
                if (label) label.textContent = 'Submitting';
                if (spinner) spinner.hidden = false;

                try {
                    const response = await fetch(commentForm.action, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: new FormData(commentForm),
                    });
                    const data = await parseJsonResponse(response);
                    commentForm.reset();
                    showInlineStatus(status, data.message || 'Your comment was submitted.', 'success');
                } catch (error) {
                    showInlineStatus(status, error.message, 'error');
                } finally {
                    button.disabled = false;
                    if (label) label.textContent = 'Submit Comment';
                    if (spinner) spinner.hidden = true;
                }
            });
        }

        const bindCommentReactions = (scope = document) => {
            scope.querySelectorAll('[data-comment-reaction]').forEach(button => {
                if (button.dataset.reactionBound === 'true') return;
                button.dataset.reactionBound = 'true';

                button.addEventListener('click', async () => {
                    const storageKey = `blog-comment-reaction-${button.dataset.commentId}`;
                    const previousReaction = localStorage.getItem(storageKey);
                    const reaction = button.dataset.commentReaction;

                    button.disabled = true;

                    try {
                        const response = await fetch(button.dataset.reactionUrl, {
                            method: 'POST',
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({ reaction }),
                        });
                        const data = await parseJsonResponse(response);
                        const card = button.closest('[data-comment-card]');
                        card.querySelector('[data-like-count]').textContent = data.likes;
                        card.querySelector('[data-dislike-count]').textContent = data.dislikes;
                        localStorage.setItem(storageKey, reaction);
                        card.querySelectorAll('[data-comment-reaction]').forEach(item => {
                            item.classList.toggle('is-active', item.dataset.commentReaction === reaction);
                        });
                    } catch (error) {
                        showStatus(document.querySelector('[data-comment-status]'), error.message, 'error');
                        if (previousReaction) {
                            localStorage.setItem(storageKey, previousReaction);
                        }
                    } finally {
                        button.disabled = false;
                    }
                });

                const savedReaction = localStorage.getItem(`blog-comment-reaction-${button.dataset.commentId}`);
                if (savedReaction === button.dataset.commentReaction) {
                    button.classList.add('is-active');
                }
            });
        };

        bindCommentReactions();

        const commentsFeed = document.querySelector('[data-comments-feed]');

        if (commentsFeed) {
            const list = document.querySelector('[data-comments-list]');
            const sortSelect = document.querySelector('[data-comments-sort]');
            const sortCustom = document.querySelector('[data-comments-sort-custom]');
            const sortToggle = document.querySelector('[data-comments-sort-toggle]');
            const sortLabel = document.querySelector('[data-comments-sort-label]');
            const sortOptions = document.querySelectorAll('[data-comments-sort-option]');
            const loadMore = document.querySelector('[data-comments-load-more]');
            const loader = document.querySelector('[data-comments-loader]');
            const label = document.querySelector('[data-comments-load-label]');
            const showing = document.querySelector('[data-comments-showing]');
            const total = document.querySelector('[data-comments-total]');
            let isLoadingComments = false;

            const closeSortMenu = () => {
                sortCustom?.classList.remove('is-open');
                sortToggle?.setAttribute('aria-expanded', 'false');
            };

            const openSortMenu = () => {
                sortCustom?.classList.add('is-open');
                sortToggle?.setAttribute('aria-expanded', 'true');
            };

            const updateSortVisual = value => {
                const activeOption = Array.from(sortOptions).find(option => option.value === value);
                if (sortLabel && activeOption) {
                    sortLabel.textContent = activeOption.textContent.trim();
                }

                sortOptions.forEach(option => {
                    const isActive = option.value === value;
                    option.classList.toggle('is-active', isActive);
                    option.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            };

            const fetchComments = async ({ page = 1, mode = 'replace' } = {}) => {
                if (isLoadingComments) return;

                isLoadingComments = true;
                if (loadMore) loadMore.disabled = true;
                if (loader) loader.hidden = false;
                if (label) label.textContent = page === 1 ? 'Loading comments' : 'Loading more';

                try {
                    const url = new URL(commentsFeed.dataset.commentsUrl, window.location.origin);
                    url.searchParams.set('page', page);
                    url.searchParams.set('sort', sortSelect?.value || 'latest');

                    const response = await fetch(url.toString(), {
                        headers: { Accept: 'application/json' },
                    });
                    const data = await parseJsonResponse(response);

                    if (mode === 'append') {
                        list.insertAdjacentHTML('beforeend', data.html);
                    } else {
                        list.innerHTML = data.html;
                    }

                    commentsFeed.dataset.commentsPage = data.current_page || page;
                    commentsFeed.dataset.commentsNextPage = data.next_page || '';
                    if (showing) showing.textContent = data.showing || 0;
                    if (total) total.textContent = data.total || 0;
                    if (loadMore) loadMore.hidden = !data.next_page;
                    bindCommentReactions(list);
                } catch (error) {
                    showInlineStatus(document.querySelector('[data-comment-status]'), error.message, 'error');
                } finally {
                    isLoadingComments = false;
                    if (loadMore) loadMore.disabled = false;
                    if (loader) loader.hidden = true;
                    if (label) label.textContent = 'Load more comments';
                }
            };

            sortSelect?.addEventListener('change', () => {
                updateSortVisual(sortSelect.value);
                commentsFeed.dataset.commentsPage = '1';
                commentsFeed.dataset.commentsNextPage = '';
                fetchComments({ page: 1, mode: 'replace' });
            });

            sortToggle?.addEventListener('click', event => {
                event.stopPropagation();
                sortCustom?.classList.contains('is-open') ? closeSortMenu() : openSortMenu();
            });

            sortOptions.forEach(option => {
                option.addEventListener('click', () => {
                    if (sortSelect) {
                        sortSelect.value = option.value;
                        sortSelect.dispatchEvent(new Event('change'));
                    }

                    closeSortMenu();
                });
            });

            document.addEventListener('click', event => {
                if (sortCustom && !sortCustom.contains(event.target)) {
                    closeSortMenu();
                }
            });

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    closeSortMenu();
                }
            });

            updateSortVisual(sortSelect?.value || 'latest');

            loadMore?.addEventListener('click', () => {
                const nextPage = Number(commentsFeed.dataset.commentsNextPage || 0);
                if (nextPage > 1) {
                    fetchComments({ page: nextPage, mode: 'append' });
                }
            });
        }

        document.querySelectorAll('[data-helpful-vote]').forEach(button => {
            const articleId = button.dataset.articleId;
            const savedVote = localStorage.getItem(`blog-helpful-${articleId}`);

            if (savedVote === button.dataset.helpfulVote) {
                button.classList.add('is-active');
            }

            button.addEventListener('click', async () => {
                const vote = button.dataset.helpfulVote;
                const status = document.querySelector('[data-helpful-status]');
                button.disabled = true;

                try {
                    const response = await fetch(button.dataset.helpfulUrl, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ vote }),
                    });
                    const data = await parseJsonResponse(response);
                    document.querySelector('[data-helpful-yes-count]').textContent = data.counts.yes;
                    document.querySelector('[data-helpful-no-count]').textContent = data.counts.no;
                    localStorage.setItem(`blog-helpful-${articleId}`, vote);
                    document.querySelectorAll('[data-helpful-vote]').forEach(item => {
                        item.classList.toggle('is-active', item.dataset.helpfulVote === vote);
                    });
                    showInlineStatus(status, data.message || 'Thanks for your feedback.', 'success');
                } catch (error) {
                    showInlineStatus(status, error.message, 'error');
                } finally {
                    button.disabled = false;
                }
            });
        });
