<?php
                                                                                        // Remove all HTML tags
                                                                                        $text = strip_tags($content);

                                                                                        // Optional: limit to first 150 characters for short description
                                                                                        $short_description = substr($text, 0, 150) . '...';

                                                                                        echo $short_description;
                                                                                        ?>
